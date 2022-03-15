<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function show($id){
        $user = new User;
        $user = User::where('id', $id)->with(['jaFui.post', 'queroIr.post', 'naoVoltaria.post'])->first();
        // dd($user);
        if (!$user) {
            abort(404);
        } else {
            return view('site.user-detail', ['user' => $user]);
        }
    }
}
