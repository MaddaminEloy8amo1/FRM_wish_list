<?php

namespace App\Http\Controllers;

use App\WishData;
use Illuminate\Http\Request;

class WishDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishData = WishData::latest()->paginate(5);

        return view('wishData.index',compact('wishData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wishData.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link' => 'required',
        ]);

        WishData::create($request->all());

        return redirect()->route('wishData.index')
            ->with('success','Wish created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WishData  $wishData
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wishData = WishData::find($id);
        return view('wishData.show',compact('wishData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WishData  $wishData
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wishData = WishData::find($id);
        return view('wishData.edit',compact('wishData','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WishData  $wishData
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $wishData = WishData::find($id);
        $wishData->img = request('img');
        $wishData->name = request('name');
        $wishData->description = request('description');
        $wishData->price = request('price');
        $wishData->link = request('link');
        $wishData->save();
        $request->validate([
            'img' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link' => 'required',
        ]);
        $wishData->update($request->all());

        return redirect()->route('wishData.index')
            ->with('success','Wish updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WishData  $wishData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WishData::find($id)->delete();

        return redirect()->route('wishData.index')
            ->with('success','Wish deleted successfully');
    }
}
