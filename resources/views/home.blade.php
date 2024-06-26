@extends('layouts.app')

@section ('titulo')

    Pagina principal

@endsection

@section('contenido')

    @if ($posts->count())
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach ($posts as $post)
                
                <div>

                    <a href=" {{route('posts.show', ['post' => $post, 'user' => $post->user])}} ">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>

                </div>

            @endforeach

        </div>
        <!-- enlazar paginacion -->
        <div class="my-10">
            
            {{ $posts->links() }}

        </div>

    @else

        <p class="text-center">Sigue a Gente para Ver sus Publicaciones</p>

    @endif    

@endsection