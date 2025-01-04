@extends('layouts.app')

@section('titulo', $titulo)

<header id="header" class="container-fluid"> <!-- inicio do header -->
    <div class="row">
        <div class="col-md-6">
            <img class="img-fluid" src=" {{ asset('images/ifmslogo.png') }}" alt="">
        </div>
        <div class="col-md-4">
            <h1>Sistema de Carga Horária</h1>
        </div>
    </div>
</header> <!-- fim do header -->

@section('main')
    <section id="menu" class="container-fluid"><!-- inicio do menu -->
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
