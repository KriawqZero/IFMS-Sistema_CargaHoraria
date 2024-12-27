<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório do Aluno</title>
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
        .progress-bar-custom {
            background-color: #00A450;
        }
        .table-container {
            background-color: #3C6F43;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .table th, .table td {
            color: white;
        }
        .link-comprovante {
            color: #00A450;
            text-decoration: none;
        }
        .link-comprovante:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="mb-4">
            <h1 class="text-center text-dark">Relatório do Aluno</h1>
        </div>

        <div class="container-custom mb-5">
            <h2 class="text-white">Total de Horas: 93,75 H</h2>
            <ul class="text-white">
                <li>1º Ano: 25,00h de 25h</li>
                <li>2º Ano: 50,00h de 50h</li>
                <li>3º Ano: 31,25h de 50h</li>
            </ul>
            <div class="progress mt-3">
                <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    75% Completo
                </div>
            </div>
        </div>

        <div class="table-container">
            <h3 class="text-white">Certificados Enviados</h3>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Data Enviada</th>
                        <th>Comprovante</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Unidade curriculares optativas/eletivas</td>
                        <td>25/07/2025 20:15</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td class="text-danger">Não Validado</td>
                    </tr>
                    <tr>
                        <td>Prática profissional integradora</td>
                        <td>18/05/2025 07:19</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td class="text-success">Validado</td>
                    </tr>
                    <tr>
                        <td>Práticas artístico-culturais</td>
                        <td>05/03/2025 19:01</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td class="text-warning">Em andamento</td>
                    </tr>
                    <tr>
                        <td>Unidade curriculares optativas/eletivas</td>
                        <td>25/07/2025 20:15</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td class="text-danger">Não Validado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
