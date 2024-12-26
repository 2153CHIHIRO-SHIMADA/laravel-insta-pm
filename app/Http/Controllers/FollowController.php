<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow)
    {
        $this->follow = $follow;
    }

    public function store($user_id)
    {
        $this->follow->follower_id = Auth::user()->id;//Chihiro if the logged user is Chihiro
        $this->follow->following_id = $user_id;//Shigemi
        $this->follow->save();

        return redirect()->back();
    }


        //Create the code
        //Add a new route
        //User the route posts/contents/title.blade.php
        //view>users>posts>show.blade.php
        //view>users>profile>header.blade.phph
    
        //Followingやめる課題



    public function destroy($user_id)
    {
       $this->follow
 
             ->where('follower_id', Auth::user()->id)
             ->where('following_id', $user_id)
             ->delete();
             return redirect()->back();            
    }
}
