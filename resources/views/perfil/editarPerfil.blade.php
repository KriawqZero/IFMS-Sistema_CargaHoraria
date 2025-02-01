@extends('_layouts.master')

@section('body')
    <div>
        <form action="{{ route('perfil.update', $usuarioLogado->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="flex h-full w-full flex-col items-center justify-center space-y-4">
                <div class="relative block h-32 w-32 overflow-hidden rounded-full shadow focus:outline-none">
                    <img class="h-full w-full object-cover" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}"
                        alt="Foto de perfil">
                </div>
                <input type="file" name="foto" class="w-32">
                <input type="text" name="nome" value="{{ $usuarioLogado->nome }}"
                    class="w-64 rounded-full bg-gray-200 px-4 py-2 text-gray-700 focus:outline-none" disabled>
                <button type="submit" class="rounded-full bg-blue-500 px-4 py-2 text-white">Salvar</button>
            </div>
        </form>
    </div>
@endsection
