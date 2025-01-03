@extends('layouts.app')

@section('titulo', $titulo)
    <!-- Header -->
    <header class="container-fluid p-3 bg-success text-white d-flex align-items-center">
      <img src="ifmslogo.png" alt="Logo IFMS" class="me-3" style="height: 50px;">
      <nav class="navbar navbar-expand-lg ms-auto">
        <div class="container-fluid">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Visão Geral</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Detalhamento</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Enviar Certificado</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="d-flex align-items-center">
        <div class="position-relative me-3">
          <i class="fas fa-bell fs-4 text-white"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            1
          </span>
        </div>
        <button class="btn btn-outline-light">Sair</button>
      </div>
    </header>

@section('main')
  <!-- Total de Horas -->
    <section class="container my-4">
      <div class="card p-4 shadow-sm">
        <h4>Total de Horas: 93,75 H</h4>
        <p>1º Ano: 25,00h de 25h</p>
        <p>2º Ano: 50,00h de 50h</p>
        <p>3º Ano: 31,25h de 50h</p>
        <ul>
          <li>Unidades curriculares optativas/eletivas: 8,75h de 120h MÁX</li>
          <li>Projetos de ensino, pesquisa e extensão: 15,00h de 80h MÁX</li>
          <li>Prática profissional integrada: 15,00h de 80h MÁX</li>
          <li>Práticas desportivas: 20,50h de 80h MÁX</li>
          <li>Práticas artístico-culturais: 32,50h de 80h MÁX</li>
        </ul>
        <div class="progress mt-3" style="height: 20px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: 75%;">75% Completo</div>
        </div>
      </div>
    </section>

    <!-- Certificados Enviados -->
    <section class="container my-4">
      <div class="card p-4 shadow-sm">
        <h4>Certificados Enviados</h4>
        <table class="table table-striped">
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
              <td>25/01/2025</td>
              <td><a href="#" class="text-success">Ver comprovante</a></td>
              <td class="text-danger">Não Validado</td>
            </tr>
            <tr>
              <td>Práticas profissionais integradoras</td>
              <td>18/05/2025</td>
              <td><a href="#" class="text-success">Ver comprovante</a></td>
              <td class="text-success">Total: 10,00 horas</td>
            </tr>
            <tr>
              <td>Práticas artístico-culturais</td>
              <td>26/03/2025</td>
              <td><a href="#" class="text-success">Ver comprovante</a></td>
              <td class="text-warning">Em andamento</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
@endsection
