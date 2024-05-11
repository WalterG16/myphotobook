<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {

        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        return view('dashboard',[
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        //REQUISITOS PARA EL REGISTRO
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);


        //CREAR REGISTROS
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        //retorna a la vista del controlador
        return redirect()->route('posts.index', auth()->user()->username);
    }

    //muestra unicamente una foto seleccionada para comentar dar like etc
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }
    
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //Elimira imagen
        $imagen_path = public_path('uploads/' . $post->imagen);
        if(File::exists($imagen_path))
        {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);

        
    }
}

