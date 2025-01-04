@extends('layouts.login')

@section('titulo', $titulo)

@section('main')
    <section id="menu" class="container-fluid">
        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
                <h3 class="text-center mb-4">Login</h3>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Formulário -->
                <form method="POST" action="{{ route('aluno.login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite seu CPF">
                    </div>

                    <!-- Senha -->
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>

                    <!-- Link para "Entrar como servidor" -->
                    <div class="text-center mt-3">
                        <a href="{{ route('professor.login') }}" class="small">Entrar como servidor</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
