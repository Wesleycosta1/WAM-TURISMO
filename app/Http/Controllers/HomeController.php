<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Auth;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    $posts = Post::with('images')->where('idUser', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
    // dd($posts);
    return view('home', ['posts' => $posts]);
    }

    public function welcome()
    {
        $posts = new Post;
        $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
        return view('welcome', ['posts' => $posts]);
    }

    public function search(Request $request)
    {
        $posts = new Post;
        $posts = Post::orWhere('titulo', 'LIKE', '%' . $request->search . '%')->orWhere('descricao', 'LIKE', '%' . $request->search . '%')->orWhere('nomeCidade', 'LIKE', '%' . $request->search . '%')->orWhere('nomeEstado', 'LIKE', '%' . $request->search . '%')->groupBy('id')->paginate(10);
        
        return view('welcome', ['posts' => $posts]);
    }
}
