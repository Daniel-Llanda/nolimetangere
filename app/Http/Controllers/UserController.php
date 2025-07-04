<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function play(){
        $status = Auth::check() ? Auth::user()->game_status : null;
        return view('play', compact('status'));
    }
    
    public function kabanata_una(){
        return view('kabanata_una.labas_ng_bahay');
    }


    public function updateStatus(Request $request){
        $user = User::find(Auth::id());

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Not authenticated'], 401);
        }

        $user->game_status = 'inside_house';
        $user->save();

        return response()->json(['success' => true]);
    }

    public function insideHouse(){
        return view('kabanata_una.loob_ng_bahay'); // Replace with your Blade view
    }




}
