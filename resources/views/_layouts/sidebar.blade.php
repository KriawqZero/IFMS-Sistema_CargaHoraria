<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
  class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed bg-slate-800 inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
  <div class="flex items-center justify-center mt-8">
    <div class="flex items-center">
      <img href="{{ route('aluno.dashboard') }}" class="mt-5 px-6"src={{ asset('images/SISCO_1.png') }} />
    </div>
  </div>

  <nav class="mt-10 text-slate-200">
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('aluno.dashboard') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('aluno.dashboard') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm5 2h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1m-5 1a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1zm9-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1" />
      </svg>
      <span class="mx-3">Visão Geral</span>
    </a>

    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('aluno.detalhamento') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('aluno.certificados.index') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
        <path
          d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
        <path
          d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
      </svg>

      <span class="mx-3">Certificados</span>
    </a>

    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('aluno.enviar-certificado') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('aluno.certificados.create') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
      </svg>

      <span class="mx-3">Enviar Certificado</span>
    </a>

    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('aluno.sobre') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('aluno.sobre') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
      </svg>

      <span class="mx-3">Sobre</span>
    </a>
  </nav>

  <div class="flex justify-center">
    <img src="{{ asset('svg/ifms-cb-logo.svg') }}" class="absolute bottom-0 my-6 h-10 mx-6" />
  </div>
</div>
