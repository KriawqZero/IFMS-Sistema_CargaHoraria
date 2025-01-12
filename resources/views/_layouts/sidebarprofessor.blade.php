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
        <path
          d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
        <path
          d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
        <path
          d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
      </svg>
      <span class="mx-3">Visão Geral </span>
    </a>

    <!-- Validar Certificados -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.certificados.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="{{ route('professor.certificados.index') }}">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
        <path
          d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
      </svg>
      <span class="mx-3">Validar Certificados</span>
    </a>

    <!-- Alunos -->
    <a class="flex items-center px-6 py-2 mt-4 {{ request()->routeIs('professor.alunos') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }}"
      href="">
      <svg class="w-8 h-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
      </svg>
      <span class="mx-3">Alunos</span>
    </a>


  </nav>
</div>
