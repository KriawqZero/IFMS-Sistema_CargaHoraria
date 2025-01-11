<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
  class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed bg-slate-800 inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
  <div class="flex items-center justify-center mt-8">
    <div class="flex items-center">
      <img href="{{ route('professor.dashboard') }}" class="mt-5 px-6" src="{{ asset('images/SISCO_1.png') }}" />
    </div>
  </div>

  <nav class="mt-10 text-slate-200">
    <!-- Visão Geral -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.dashboard') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('professor.dashboard') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M2.5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
        <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
      </svg>
      <span class="mx-3">Visão Geral</span>
    </a>

    <!-- Validar Certificados -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.validar') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
        <path d="M5 10.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z" />
      </svg>
      <span class="mx-3">Validar Certificados</span>
    </a>

    <!-- Alunos -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.alunos') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 1a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm1 7a4 4 0 1 1 8 0H5z" />
      </svg>
      <span class="mx-3">Alunos</span>
    </a>

    <!-- Resumo da Turma -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.resumo') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M9 0a9 9 0 1 0 9 9A9 9 0 0 0 9 0zm0 2a7 7 0 1 1-7 7A7 7 0 0 1 9 2z" />
        <path d="M8 5a1 1 0 0 1 1-1h1v7a1 1 0 0 1-2 0z" />
      </svg>
      <span class="mx-3">Resumo da Turma</span>
    </a>
  </nav>

  <div class="flex justify-center">
    <img src="{{ asset('svg/ifms-cb-logo.svg') }}" class="absolute bottom-0 my-6 h-10 mx-6" />
  </div>
</div>
