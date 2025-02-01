@extends('_layouts.master')

@section('body')
    <div class="lg:pb-12 lg:pl-12 lg:pr-12">
        <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
            <div>
                <h3 class="mt-5 text-3xl font-bold text-gray-900">
                    Enviar Certificado!
                </h3>
                <p class="mt-2 text-sm text-gray-400">Aqui você pode enviar seu arquivo para validação de carga horária.</p>
            </div>

            @if ($errors->any())
                <div class="mt-5 rounded-lg bg-red-100 p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif(session('success'))
                <div class="mt-5 rounded-lg bg-green-100 p-4">
                    <ul>
                        <li class="text-green">{{ session('success') }}</li>
                    </ul>
                </div>
            @endif

            <form enctype="multipart/form-data" class="mt-8 space-y-3" action="{{ route('aluno.certificados.store') }}"
                method="POST">
                @csrf

                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold tracking-wide text-gray-500">Categoria</label>

                    <select name="categoria_id"
                        class="rounded-lg border border-gray-300 p-2 text-base focus:border-green-500 focus:outline-none">
                        <option value="" disabled selected>Selecione uma opção</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold tracking-wide text-gray-500">Titulo do Certificado</label>
                    <input type="text" name="titulo"
                        class="rounded-lg border border-gray-300 p-2 text-base focus:border-green-500 focus:outline-none"
                        placeholder="Oficina/Workshop - Brinquedos com materiais reciclados" />
                    <label class="text-sm font-bold tracking-wide text-gray-500">Carga Horária (em horas)</label>
                    <input type="text" name="carga_horaria" placeholder="hh:mm (Ex: 12:30)" pattern="^\d{1,3}:[0-5]\d$"
                        class="rounded-lg border border-gray-300 p-2 text-base focus:border-green-500 focus:outline-none">
                    <label class="text-sm font-bold tracking-wide text-gray-500">Data do Certificado</label>
                    <input x-data="{ today: new Date().toISOString().split('T')[0], selectedDate: '' }" type="date" name="data_do_certificado" min="2021-01-01"
                        x-bind:max="today"
                        class="rounded-lg border border-gray-300 p-2 text-base focus:border-green-500 focus:outline-none" />
                    <label class="text-sm font-bold tracking-wide text-gray-500">Observação</label>
                    <textarea name="observacao"
                        class="rounded-lg border border-gray-300 p-2 text-base focus:border-green-500 focus:outline-none"></textarea>
                </div>
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold tracking-wide text-gray-500">Anexar documento</label>
                    <input type="file" name="arquivo"
                        class="mt-2 block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-green-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white file:transition file:duration-300 file:ease-in hover:file:bg-green-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60" />
                </div>
                <p class="text-sm text-gray-400">
                    <span>Arquivos permitidos: .jpg, .png, .webp, .pdf</span>
                </p>
                <div>

                    <button type="submit"
                        class="focus:shadow-outline my-5 flex w-full cursor-pointer justify-center rounded-full bg-green-600 p-4 font-semibold tracking-wide text-white shadow-lg transition duration-300 ease-in hover:bg-green-700 focus:outline-none">
                        Enviar
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
