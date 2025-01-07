@extends('layouts.dashboard')

@section('titulo', $titulo)

@push('style')
    @vite('resources/scss/detalhamento.scss')
@endpush

@section('main')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 900px; border-radius: 30px;">
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

            <div class="table-container">
                <table class="table table-hover">
                    <thead>
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
                            <td>Unidade curriculares optativas/eletivas</td>
                            <td>25/07/2025 20:15</td>
                            <td><a href="#">Ver comprovante</a></td>
                            <td>Lorem ipsum dolor</td>
                            <td class="status-invalid">Não Validado</td>
                            <td>100 horas</td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success" title="Aprovar"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Prática profissional integradora</td>
                            <td>18/05/2025 07:19</td>
                            <td><a href="#">Ver comprovante</a></td>
                            <td>Lorem ipsum dolor</td>
                            <td class="status-valid">Validado! <br>Total: 10,0 horas</td>
                            <td>10 horas</td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success" title="Aprovar"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Práticas artístico-culturais</td>
                            <td>05/03/2025 19:01</td>
                            <td><a href="#">Ver comprovante</a></td>
                            <td>Lorem ipsum dolor</td>
                            <td class="status-pending">Em andamento</td>
                            <td>20 horas</td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-danger" title="Excluir"><i class="fas fa-trash"></i></button>
                                <button class="btn btn-sm btn-success" title="Aprovar"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination-info">Exibindo 4 de 9</div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush


