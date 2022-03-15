<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;
use Auth;
use Redirect;

class InterestController extends Controller
{

    public function interestDestroy($id){
        $interest = new Interest;
        $interest = Interest::where('idUser', Auth::user()->id)->where('id', $id)->first();
        if ($interest) {
            $interest->delete();
        }
        return Redirect::back();
    }


    public function viewQueroIr(){
        $interests = new Interest;
        $interests = Interest::with('post')->where('idUser', Auth::user()->id)->where('type', 1)->paginate(10);
        return view('painel.interests-view', ['interests' => $interests]);
    }

    public function viewJaFui(){
        $interests = new Interest;
        $interests = Interest::with('post')->where('idUser', Auth::user()->id)->where('type', 2)->paginate(10);
        return view('painel.interests-view', ['interests' => $interests]);
    }

    public function viewNaoVoltaria(){
        $interests = new Interest;
        $interests = Interest::with('post')->where('idUser', Auth::user()->id)->where('type', 3)->paginate(10);
        return view('painel.interests-view', ['interests' => $interests]);
    }


    public function queroIr(Request $request){

        $interest = new Interest;
        $interest = Interest::where('idUser', Auth::user()->id)->where('idPost', $request->idPost)->first();
        
        if (!$interest) {

             $newInterest = new Interest;
             $newInterest = $newInterest->create(['idUser' => Auth::user()->id, 'idPost' => $request->idPost, 'type' => $request->interest]);

         } else if($interest->type != $request->interest){

            $interest->type = $request->interest;
            $interest->save();

         }

         return Redirect::back();
    }

    public function jaFui(Request $request){

        $interest = new Interest;
        $interest = Interest::where('idUser', Auth::user()->id)->where('idPost', $request->idPost)->first();

        if (!$interest) {

             $newInterest = new Interest;
             $newInterest = $newInterest->create(['idUser' => Auth::user()->id, 'idPost' => $request->idPost, 'type' => $request->interest]);

         } else if($interest->type != $request->interest){

            $interest->type = $request->interest;
            $interest->save();

         }

         return Redirect::back();
    }

    public function naoIriaNovamente(Request $request){

        $interest = new Interest;
        $interest = Interest::where('idUser', Auth::user()->id)->where('idPost', $request->idPost)->first();

        if (!$interest) {
             $newInterest = new Interest;
             $newInterest = $newInterest->create(['idUser' => Auth::user()->id, 'idPost' => $request->idPost, 'type' => $request->interest]);

         } else if($interest->type != $request->interest){
            $interest->type = $request->interest;
            $interest->save();

         }

         return Redirect::back();
    }
}
