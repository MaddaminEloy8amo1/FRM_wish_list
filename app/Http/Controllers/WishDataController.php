<?php

namespace App\Http\Controllers;

use App\User;
use App\WishData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishDataController extends Controller
{

    public function __construct(){
        $this->middleware('auth', ['except' => ['welcome']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userId = Auth::user()->id;
        $wishData = WishData::where(['user_id' => $userId])->paginate(5);
        $users = User::all();

        return view('wishData.index', compact('users'), compact('wishData'))
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
     * Show the admin page.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $users = User::all()->except(Auth::user()->id);

        if (Auth::user()->is_admin == 1) {
            return view('wishData.admin', compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        } else {
            return redirect()->route('wishData.index');
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|max:2048',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'link' => 'required',
        ]);

        $image = $request->file('img');

        $userId = Auth::user()->id;
        $input = $request->input();
        $input['user_id'] = $userId;

        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $input['img'] = $new_name;

        $wishStatus = WishData::create($input);
        if ($wishStatus) {
            $request->session()->flash('success', 'Wish created successfully.');
        } else {
            $request->session()->flash('error', 'Oops something went wrong, Wish not created');
        }

        return redirect()->route('wishData.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\WishData $wishData
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userWishData = WishData::where(['user_id' => $id])->paginate(5);
        $userName = User::find($id);

        return view('wishData.index', compact('userWishData'), compact('userName'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\WishData $wishData
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uId = WishData::where(['id' => $id])->pluck('user_id');
        $userId = trim($uId, '[]');

        $wishData = WishData::where(['user_id' => $userId, 'id' => $id])->first();

        if (Auth::user()->id == $userId) {
            if ($wishData) {
                return view('wishData.edit', ['wishData' => $wishData]);
            } else {
                return redirect()->route('wishData.index')->with('error', 'Wish not found');
            }
        } else {
            if ($wishData) {
                return view('wishData.edit', ['wishData' => $wishData]);
            } else {
                return redirect()->route('wishData.show')->with('error', 'Wish not found');
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\WishData $wishData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $uId = WishData::where(['id' => $id])->pluck('user_id');
        $userId = trim($uId, '[]');

        $wishData = WishData::find($id);

        if (Auth::user()->id == $userId) {
            if (!$wishData) {
                return redirect()->route('wishData.index')->with('error', 'Wish not found.');
            }
        } else {
            if (!$wishData) {
                return redirect()->route('wishData.show', $userId)->with('error', 'Wish not found.');
            }
        }

        $image_name = $request->hidden_image;
        $image = $request->file('img');
        if ($image != '') {
            $request->validate([
                'img' => 'required|image|max:2048',
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'link' => 'required',
            ]);

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        } else {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'link' => 'required',
            ]);
        }

        $input = $request->input();
        $input['user_id'] = $userId;

        $input['img'] = $image_name;

        $wishStatus = $wishData->update($input);
        if (Auth::user()->id == $userId) {
            if ($wishStatus) {
                return redirect()->route('wishData.index')->with('success', 'Wish successfully updated.');
            } else {
                return redirect()->route('wishData.index')->with('error', 'Oops something went wrong. Wish not updated');
            }
        } else {
            if ($wishStatus) {
                return redirect()->route('wishData.show', $userId)->with('success', 'Wish successfully updated.');
            } else {
                return redirect()->route('wishData.show', $userId)->with('error', 'Oops something went wrong. Wish not updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\WishData $wishData
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uId = WishData::where(['id' => $id])->pluck('user_id');
        $userId = trim($uId, '[]');
        WishData::where(['user_id' => $userId, 'id' => $id])->delete();

        if (Auth::user()->id == $userId) {
            return redirect()->route('wishData.index')->with('success', 'Wish successfully deleted.');
        } else {
            return redirect()->route('wishData.show', $userId)->with('success', 'Wish successfully deleted.');
        }
    }
}
