@extends('layouts.login')

@section('titulo', $titulo)

@section('main')
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
            <h4 class="text-center mb-4">Login como Servidor</h4>
            <form>
                <!-- CPF -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" required>
                </div>

                <!-- Senha -->
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" required>
                </div>

                <!-- Botão Entrar -->
                <button type="submit" class="btn btn-success w-100">Entrar</button>

                <!-- Link para Servidor -->
                <div class="text-center mt-3">
                    <a href="../Login/login.html" class="small">Entrar como Aluno</a>
                </div>
            </form>
        </div>
    </section>
@endsection
