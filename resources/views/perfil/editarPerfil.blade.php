@extends('_layouts.master')

@section('body')
<div>
  <form action="{{ route('perfil.update', $usuarioLogado->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="flex flex-col items-center justify-center w-full h-full space-y-4">
      <div class="relative block w-32 h-32 overflow-hidden rounded-full shadow focus:outline-none">
        <img class="object-cover w-full h-full" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}" alt="Foto de perfil">
      </div>
      <input type="file" name="foto" class="w-32">
      <input type="text" name="nome" value="{{ $usuarioLogado->nome }}" class="w-64 px-4 py-2 text-gray-700 bg-gray-200 rounded-full focus:outline-none" disabled>
      <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-full">Salvar</button>
    </div>
  </form>
</div>
@endsection
