<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhamento de Certificados</title>
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
            <h1 class="text-center text-dark">Detalhamento de Certificados</h1>
        </div>

        <div class="container-custom mb-5">
            <h2 class="text-white">Certificados</h2>
            <p class="text-white">Turma: 2020/2</p>
            <p class="text-white">Professor Responsável: Paulo</p>
            <p class="text-white">Horas completadas: 93,75 de 125h</p>
        </div>

        <div class="table-container">
            <h3 class="text-white">Certificados Enviados</h3>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="text-white mb-0">Resultados por página:</p>
                <select class="form-select w-auto">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Data Enviada</th>
                        <th>Comprovante</th>
                        <th>Observação</th>
                        <th>Status</th>
                        <th>Carga Horária</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Unidade curriculares optativas/eletivas</td>
                        <td>25/07/2025 20:15</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-danger">Não Validado</td>
                        <td>120 horas</td>
                    </tr>
                    <tr>
                        <td>Prática profissional integradora</td>
                        <td>18/05/2025 07:19</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-success">Validado</td>
                        <td>100 horas</td>
                    </tr>
                    <tr>
                        <td>Práticas artístico-culturais</td>
                        <td>05/03/2025 19:01</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-warning">Em andamento</td>
                        <td>---</td>
                    </tr>
                    <tr>
                        <td>Unidade curriculares optativas/eletivas</td>
                        <td>25/07/2025 20:15</td>
                        <td><a href="#" class="link-comprovante">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-danger">Não Validado</td>
                        <td>120 horas</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <footer class="text-center mt-5 text-muted">IFMS - Campus Corumbá</footer>
    </div>
</body>
</html>
