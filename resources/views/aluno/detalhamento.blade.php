@extends('layouts.dashboard')

@section('titulo', $titulo)

@section('main')
   

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 900px; border-radius: 15px;">
        <h5 class="card-title mb-4">Certificados</h5>
        <p><strong>Turma:</strong> 20210</p>
        <p><strong>Professor Responsável:</strong> Paulo</p>
        <p><strong>Horas completadas:</strong> 93.75 de 125h</p>

        <div class="mb-3 d-flex justify-content-end">
            <label for="entries" class="form-label me-2">Resultados por página:</label>
            <select id="entries" class="form-select form-select-sm w-auto">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success text-center">
                    <tr>
                        <th>Tipo</th>
                        <th>Data Enviada</th>
                        <th>Comprovante</th>
                        <th>Observação</th>
                        <th>Status</th>
                        <th>Carga Horária</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Unidades curriculares optativas/eletivas</td>
                        <td>25/03/2025 20:15</td>
                        <td><a href="#" class="text-primary">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-danger">Não Validado</td>
                        <td>100 horas</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Práticas profissionais integradoras</td>
                        <td>18/05/2025 09:15</td>
                        <td><a href="#" class="text-primary">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-success">Validado</td>
                        <td>100 horas</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>Políticas artístico-culturais</td>
                        <td>06/03/2025 19:02</td>
                        <td><a href="#" class="text-primary">Ver comprovante</a></td>
                        <td>Lorem ipsum dolor</td>
                        <td class="text-warning">Em andamento</td>
                        <td>100 horas</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
