<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\User;
use App\video;
use App\comment;

class UserController extends Controller
{
    //
    public function channel($user_id){
      $user = User::find($user_id);

      if(!is_object($user)){
        return redirect()->route('home');
      }

      $videos = video::where('user_id', $user_id)->paginate(5);

      return view('user.chanel', array(
        'user' => $user,
        'videos' => $videos
      ));
    }
}
