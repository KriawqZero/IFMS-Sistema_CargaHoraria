@extends('layouts.login')

@section('titulo', $titulo)

@push('styles')
    @vite('resources/scss/login.scss')
@endpush

@section('main')
     <section class="menu d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="login-card p-4 rounded shadow-lg" style="max-width: 400px; width: 100%;">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4 class="text-center mb-4">Login como Aluno</h4>

            <form method="POST" action="{{ route('aluno.login.post') }}">
                @csrf
                <!-- CPF -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Digite seu CPF">
                </div>

                <!-- Senha -->
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha">
                </div>

                <!-- Botão Entrar -->
                <button type="submit" class="btn btn-success w-100">Entrar</button>

                <!-- Link para Servidor -->
                <div class="text-center mt-3">
                    <a href="{{ route('professor.login') }}" class="small">Entrar como Servidor</a>
                </div>
            </form>
        </div>
    </section>
@endsection
