<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Estudante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Inter, sans-serif;
            background-color: #3C6F43;
        }
        .container-custom {
            background-color: #2A6430;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 2rem;
        }
        .btn-custom {
            background-color: #00A450;
            color: white;
        }
        .btn-custom:hover {
            background-color: #00803A;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">

        <div class="container-custom w-100" style="max-width: 400px;">
            <h1 class="text-center text-white mb-4">Login Estudante</h1>
            <p class="text-center text-white mb-4">Bem-vindo ao sistema de acesso de estudantes.</p>

            <form method="POST" action="{{ url('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="cp" class="form-label text-white">CPF</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="00000000000" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Sua senha" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom">Entrar</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="#" class="text-white">Esqueceu a senha?</a>
            </div>

        </div>
    </div>
</body>
</html>
