@extends('layouts.app')

@section('titulo')

    Inicia Sesion en MyPhotoBook

@endsection

@section('contenido')
    
    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class="w-full h-full border-8 border-gray-200 shadow-lg rounded-3xl md:w-6/12  ">

            <img class="rounded-2xl" src="{{ asset('img/login2.jpeg') }}" alt="Imagen de login de Usuarios">

        </div>

        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-2xl">

            <form method="POST" action=" {{route('login')}} ">
                @csrf

                @if (session('mensaje'))

                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }} </p>
                    
                @endif
                
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>

                    <input 
                            id="email" 
                            name="email" 
                            type="text" 
                            placeholder="Tu Email de Registro"
                            class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>

                    <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            placeholder="Contraseña"
                            class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    >
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-5">

                    <input type="checkbox" name="remember"> <label class="text-gray-500 text-sm"> Mantener la sesion abierta</label>

                </div>

                <input 
                        type="submit" 
                        value="Iniciar Sesion" 
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" >

            </form>

        </div>

    </div>

@endsection