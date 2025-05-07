<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
  class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed inset-y-0 left-0 z-30 flex w-64 flex-col bg-slate-800 transition duration-300 lg:static lg:inset-0 lg:translate-x-0">

  <div class="flex-1 overflow-y-auto">
    <div class="mt-8 flex items-center justify-center">
      <div class="flex items-center">
        <img href="{{ route('aluno.dashboard') }}" class="mt-5 px-6"src={{ asset('images/SISCO_1.png') }} />
      </div>
    </div>

    <nav class="mt-10 text-slate-200">
      <a class="{{ request()->routeIs('aluno.dashboard') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} mt-4 flex items-center px-6 py-2"
        href="{{ route('aluno.dashboard') }}">
        <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1m-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1" />
        </svg>
        <span class="mx-3">Visão Geral</span>
      </a>

      <a class="{{ request()->routeIs('aluno.certificados.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} mt-4 flex items-center px-6 py-2"
        href="{{ route('aluno.certificados.index') }}">
        <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
          <path
            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
          <path
            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
        </svg>

        <span class="mx-3">Certificados</span>
      </a>

      <a class="{{ request()->routeIs('aluno.certificados.create') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} mt-4 flex items-center px-6 py-2"
        href="{{ route('aluno.certificados.create') }}">
        <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
        </svg>

        <span class="mx-3">Enviar Certificado</span>
      </a>

      <a class="{{ request()->routeIs('notas-de-atualizacao') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} mt-4 flex items-center px-6 py-2 py-2"
        href="{{ route('notas-de-atualizacao') }}">
        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path
            d="m19.828 3.414-2.242-2.242a3.975 3.975 0 0 0 -2.829-1.172h-8.757a3 3 0 0 0 -3 3v21h18v-17.758a4.022 4.022 0 0 0 -1.172-2.828zm-1.414 1.414a1.923 1.923 0 0 1 .141.172h-2.555v-2.555a1.923 1.923 0 0 1 .172.141zm-13.414 17.172v-19a1 1 0 0 1 1-1h8v5h5v15zm2-6h10v-6h-10zm2-4h6v2h-6zm-2 6h10v2h-10z" />
        </svg>
        <span class="mx-3">Notas de Atualização</span>
      </a>
    </nav>
  </div>

  <div class="mt-auto py-4">
    <div class="flex flex-col items-center gap-4">
      <img src="{{ asset('svg/ifms-cb-logo.svg') }}" class="h-10" />
      <div class="px-4 text-center text-xs text-slate-600">
        <span id="version-info"> </span>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Função para formatar a data
  function formatarData(dataString) {
    const data = new Date(dataString);
    return data.toLocaleDateString('pt-BR');
  }

  // Função para atualizar a versão
  async function atualizarVersao() {
    try {
      const response = await fetch('/api/version');
      const data = await response.json();
      
      if (data.version) {
        const versao = data.version;
        const dataFormatada = formatarData(versao.date);
        document.getElementById('version-info').textContent = 
          `SISCO V${versao.version} (${dataFormatada}) por Marcilio Ortiz e Davi Nunes`;
      }
    } catch (error) {
      console.error('Erro ao buscar versão:', error);
    }
  }

  // Atualizar a versão quando a página carregar
  document.addEventListener('DOMContentLoaded', atualizarVersao);
</script>
@endpush
