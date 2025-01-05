@extends('layouts.login')

@section('titulo', $titulo)

@section('main')
    <div id="loginprofessor">
    <section class="menu d-flex justify-content-center align-items-center">
        <div class="login-card p-4 rounded shadow">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4 class="text-center mb-4">Login como Professor</h4>

            <form method="POST" action="{{ route('aluno.login.post') }}">
                @csrf
                <!-- CPF -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">Login (nome.sobrenome)</label>
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
                    <a href="{{ route('aluno.login') }}" class="small">Entrar como Aluno</a>
                </div>
            </form>
        </div>
    </section>
    </div>
@endsection
