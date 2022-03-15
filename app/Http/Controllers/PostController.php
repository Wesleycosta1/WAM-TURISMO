<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Interest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Redirect;
use Auth;
use DB;
class PostController extends Controller
{
    public function category($id)
    {
        switch ($id) {
            case 1:

                $results = DB::select( DB::raw("SELECT COUNT(cidade) as visitas, ROUND(AVG(CAST(avaliacao AS FLOAT)), 1) as avaliacao, cidade, nomeCidade, nomeEstado FROM posts GROUP BY cidade order by visitas DESC") );
                if ($results) {
                    return view('site.category-result', ['results' => $results, 'cidade' => true]);
                } else {
                    abort(404);
                }

            case 2:

                $results = DB::select( DB::raw("SELECT COUNT(nomeEstado) as visitas, ROUND(AVG(CAST(avaliacao AS FLOAT)), 1) as avaliacao, nomeEstado FROM posts GROUP BY nomeEstado order by visitas DESC") );        
                if ($results) {
                    return view('site.category-result', ['results' => $results, 'estado' => true]);
                } else {
                    abort(404);
                }

            case 3:
                $results = DB::select( DB::raw("SELECT ROUND(AVG(CAST(avaliacao AS FLOAT)), 1) as avaliacao, nomeCidade, nomeEstado FROM posts GROUP BY cidade order by avaliacao DESC") );        
                if ($results) {
                    return view('site.category-result', ['results' => $results, 'cidade' => true]);
                } else {
                    abort(404);
                }

            case 4:
                $results = DB::select( DB::raw("SELECT ROUND(AVG(CAST(avaliacao AS FLOAT)), 1) as avaliacao, nomeCidade, nomeEstado FROM posts GROUP BY cidade order by avaliacao DESC") );        
                if ($results) {
                    return view('site.category-result', ['results' => $results, 'estado' => true]);
                } else {
                    abort(404);
                }
            case 5:
                $results = DB::table('interests')
                               ->join('posts', 'interests.idPost', '=', 'posts.id')
                               ->select('posts.nomeCidade', 'posts.nomeEstado', DB::raw('ROUND(AVG(CAST(posts.avaliacao AS FLOAT)), 1) as avaliacao, count(*) as total', 'interests.type'))
                               ->where('interests.type', 1)
                               ->groupBy('posts.cidade')
                               ->orderBy('total', 'DESC')
                               ->paginate(10);
                // dd($results);
                return view('site.category-result', ['results' => $results, 'titulo' => 'Quero Ir: ']);
            case 6:
                $results = DB::table('interests')
                               ->join('posts', 'interests.idPost', '=', 'posts.id')
                               ->select('posts.nomeCidade', 'posts.nomeEstado', DB::raw('ROUND(AVG(CAST(posts.avaliacao AS FLOAT)), 1) as avaliacao, count(*) as total', 'interests.type'))
                               ->where('interests.type', 2)
                               ->groupBy('posts.cidade')
                               ->orderBy('total', 'DESC')
                               ->paginate(10);
                return view('site.category-result', ['results' => $results, 'titulo' => 'Já Fui: ']);
            case 7:
                $results = DB::table('interests')
                               ->join('posts', 'interests.idPost', '=', 'posts.id')
                               ->select('posts.nomeCidade', 'posts.nomeEstado', DB::raw('ROUND(AVG(CAST(posts.avaliacao AS FLOAT)), 1) as avaliacao, count(*) as total', 'interests.type'))
                               ->where('interests.type', 3)
                               ->groupBy('posts.cidade')
                               ->orderBy('total', 'DESC')
                               ->paginate(10);
                return view('site.category-result', ['results' => $results, 'titulo' => 'Não voltaria: ']);
            default:
                    abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $post = new Post;
        $data = ($request->safe()->except(['fotos']));
        $data['idUser'] = Auth::user()->id;
        $data['nomeCidade'] = $request->nomeCidade;
        $data['nomeEstado'] = $request->nomeEstado;
        $post = $post::create($data);
        if ($request->hasFile('fotos')) {
            moverImagens($post->id, 'img/post', $request->safe()->only(['fotos']));
        }
        return Redirect::to('painel/home');  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = new Post;
        $post = Post::with('images', 'comments.owner', 'owner')->withCount('jaFui', 'queroIr', 'naoIriaNovamente')->findOrFail($id);
        // dd($post);

        $jafoi = false;

        if (Auth::user()) {
            $interest = new Interest;
            $interest = Interest::where('idPost', $post->id)->where('idUser', Auth::user()->id)->first();
            if ($interest) {
                if ($interest->type == 2) {
                    $jafoi = true;
                }
            }
        }
        return view('site.view', ['post' => $post, 'jaFoi' => $jafoi]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = new Post;
        $post = Post::where('id', $id)->with('owner')->first();
        if ($post) {
            if (($post->owner->id == Auth::user()->id) || (Auth::user()->type == 2)) {
                $post->delete();
            }
        }
        return Redirect::to('/');
    }
}
