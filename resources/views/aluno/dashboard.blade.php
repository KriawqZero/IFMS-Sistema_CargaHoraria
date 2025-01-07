@extends('layouts.dashboard')

@section('titulo', $titulo)

@section('main')
    <div class="v-flex justify-content-center align-items-center vh-100">
        <!-- Total de Horas -->
        <section style="border-radius: 30px;" class="card container shadow-lg my-4">
            <div class="p-4">
                <h2 class='mb-3'>Olá, {{ $aluno->nome }}!</h2>
                <h4>Total de Horas: {{ $cargaHorariaTotal }} H</h4>
                <ul>
                    @foreach ($limitesCargaHoraria as $tipo => $limite)
                        <li>
                            {{ $tipo }}:
                            {{ isset($cargaHorariaPorTipo[$tipo]) ? number_format($cargaHorariaPorTipo[$tipo], 2, ',', '.') : '0,00' }}h de
                            {{ number_format($limite, 2, ',', '.') }}h
                        </li>
                    @endforeach
                </ul>
                <div class="progress mt-3" style="height: 20px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ ($cargaHorariaTotal / $maxCargaHoraria) * 100 }}%;">{{ round(($cargaHorariaTotal / $maxCargaHoraria) * 100) }}% Completo</div>
                </div>
            </div>
        </section>

        <!-- Certificados Enviados -->
        <section style="border-radius: 30px" class="card container shadow-lg my-4">
            <div class="p-4">
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
                        @foreach ($certificados as $certificado)
                            <tr>
                                <td>{{ $certificado->tipo }}</td>
                                <td>{{ \Carbon\Carbon::parse($certificado->created_at)->format('d/m/Y \à\s H:i:s') }}</td>
                                <td><a href="{{ $certificado->src }}" class="text-success">Ver comprovante</a></td>
                                <td class="
                                    @if($certificado->status == 'validado') text-success
                                    @elseif($certificado->status == 'em_andamento') text-warning
                                    @else text-danger
                                    @endif
                                 ">
                                    @if($certificado->status == 'validado') Validado
                                    @elseif($certificado->status == 'em_andamento') Em andamento
                                    @else Não validado
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
