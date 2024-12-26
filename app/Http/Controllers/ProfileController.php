<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('users.profile.show')->with('user',$user);
    }

    
    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')
        ->with('user',$user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:1|max:50',
            'email' =>'required|email:max:50|unique:users,email,' . Auth::user()->id,
            'avatar'  => 'mimes:jpg,jpeg,gif,png|max:1048',
            'introduction' =>'max:100'
        ]);

        $user  = $this->user->findOrFail(Auth::user()->id);
        $user->name    =   $request->name;
        $user->email    =   $request->email;
        $user->introduction    =   $request->introduction;

        if($request->avatar){
            $user->avatar= 'data:image/'. $request->avatar->extension(). ';base64,'.base64_encode(file_get_contents($request->avatar));
        }

        #save
        $user->save();

        #redirect
        return redirect()->route('profile.show', Auth::user()->id);


        #1. Add the error directives on the Edit Profile view
        #2.Update().Update the name,email, and introduction
        #3.If the user uploaded on avatar, update it
        #4.Save.
        #5.Redirect to Show Profile page</div>
    }


   //Followingをやめる課題
    public function destroy()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.destroy')
        ->with('user',$user);
    }

    public function followers($id)
    {
        $user=$this->user->findOrFail($id);
        return view('users.profile.followers')->with('user', $user);
    }

//Following　出す課題
    public function following($id)
    {
        $user=$this->user->findOrFail($id);
        return view('users.profile.following')->with('user', $user);
    }
}
