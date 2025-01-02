<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Certificados</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }
        .container-custom {
            background-color: #2A6430;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 2rem;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 164, 80, 0.5);
            border-color: #00A450;
        }
        .btn-submit {
            background-color: #00A450;
            color: white;
        }
        .btn-submit:hover {
            background-color: #007A3A;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="mb-4">
            <h1 class="text-center text-dark">Envio de Certificados</h1>
        </div>

        <div class="container-custom mb-5">
            <form>
                <div class="mb-3">
                    <label for="tipoAtividade" class="form-label text-white">Tipo de Atividade <span class="text-danger">*</span></label>
                    <select id="tipoAtividade" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="optativas">Unidades curriculares optativas/eletivas</option>
                        <option value="pratica">Prática profissional integradora</option>
                        <option value="artistico">Práticas artístico-culturais</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="arquivo" class="form-label text-white">Arquivo <span class="text-danger">*</span></label>
                    <input type="file" id="arquivo" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="observacao" class="form-label text-white">Observação</label>
                    <textarea id="observacao" class="form-control" rows="3" placeholder="Digite sua observação..."></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-submit">Enviar</button>
                </div>

                <div class="mt-3 text-center">
                    <span class="text-success">Enviado com sucesso</span>
                    <span class="text-danger"> - Falha no envio</span>
                </div>
            </form>
        </div>

        <footer class="text-center mt-5 text-muted">IFMS - Campus Corumbá</footer>
    </div>
</body>
</html>
