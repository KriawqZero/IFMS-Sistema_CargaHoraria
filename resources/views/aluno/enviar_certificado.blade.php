@extends('layouts.dashboard')

@section('titulo', $titulo)

@section('main')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 500px; border-radius: 30px;">
            <h5 class="card-title text-center">Enviar Certificado</h5>
            <form>
                <!-- Tipo de Atividade -->
                <div class="mb-3">
                    <label for="tipoAtividade" class="form-label">Tipo de Atividade <span class="text-danger">*</span></label>
                    <select class="form-select" id="tipoAtividade" required>
                        <option value="" selected>Selecione...</option>
                        <option value="Unidades curriculares optativas/eletivas">Unidades curriculares optativas/eletivas</option>
                        <option value="Projetos de ensino, pesquisa e extensão">Projetos de ensino, pesquisa e extensão</option>
                        <option value="Prática profissional integradora">Prática profissional integradora</option>
                        <option value="Práticas desportivas">Práticas desportivas</option>
                        <option value="Práticas artístico-culturais">Práticas artístico-culturais</option>
                    </select>
                </div>

                <!-- Arquivo -->
                <div class="mb-3">
                    <label for="arquivo" class="form-label">Arquivo <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="arquivo" required>
                </div>

                <!-- Observação -->
                <div class="mb-3">
                    <label for="observacao" class="form-label">Observação</label>
                    <textarea class="form-control" id="observacao" placeholder="Hint text"></textarea>
                </div>

                <!-- Mensagem de Sucesso/Erro -->
                <div class="text-center mb-3">
                    <span class="text-success d-none" id="successMessage">Enviado com sucesso</span>
                    <span class="text-danger d-none" id="errorMessage">Falha no envio</span>
                </div>

                <!-- Botão de Enviar -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
