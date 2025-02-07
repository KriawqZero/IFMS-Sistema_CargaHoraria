<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
  class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed inset-y-0 left-0 z-30 w-64 transform overflow-y-auto bg-slate-800 transition duration-300 lg:static lg:inset-0 lg:translate-x-0">
  <div class="mt-8 flex items-center justify-center">
    <div class="flex items-center">
      <img href="{{ route('professor.dashboard') }}" class="mt-5 px-6" src="{{ asset('images/SISCO_1.png') }}" />
    </div>
  </div>

  <nav class="mt-10 text-slate-200">
    <!-- Visão Geral -->
    <a class="{{ request()->routeIs('professor.dashboard') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.dashboard') }}">
      <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
    <a class="{{ request()->routeIs('professor.certificados.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.certificados.index') }}">
      <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z" />
        <path
          d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0" />
      </svg>
      <span class="mx-3">Certificados</span>
    </a>

    <!-- Alunos -->
    <a class="{{ request()->routeIs('professor.alunos.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.alunos.index') }}">
      <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
      </svg>
      <span class="mx-3">Alunos</span>
    </a>

    <a class="{{ request()->routeIs('professor.create.alunos') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.create.alunos') }}">
      <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M9.5,4.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5-1.119,2.5-2.5,2.5-2.5-1.119-2.5-2.5Zm7.5,14.5h-2v5h-2v-5h-2v5h-2v-5h-2V11c0-1.654,1.346-3,3-3h4c1.654,0,3,1.346,3,3v8Zm2.5-14c1.381,0,2.5-1.119,2.5-2.5s-1.119-2.5-2.5-2.5-2.5,1.119-2.5,2.5,1.119,2.5,2.5,2.5ZM7,2.5C7,1.119,5.881,0,4.5,0S2,1.119,2,2.5c0,1.381,1.119,2.5,2.5,2.5s2.5-1.119,2.5-2.5Zm-2,8.5c0-2.161,1.387-3.989,3.311-4.686h0c-.398-.195-.839-.314-1.311-.314H3c-1.654,0-3,1.346-3,3v8H2v5h2v-5l1-.037v-5.963Zm14,5.963l1,.037v5s2,0,2,0v-5h2s0-8,0-8c0-1.654-1.346-3-3-3h-4c-.472,0-.913,.119-1.311,.314h0c1.924,.697,3.311,2.524,3.311,4.686v5.963Z" />
      </svg>
      <span class="mx-3">Cadastrar Alunos</span>
    </a>

    <a class="{{ request()->routeIs('professor.turmas.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.turmas.index') }}">
      <svg class="h-8 w-8" viewBox="0 0 18 18" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
        <path
          d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
      </svg>
      <span class="mx-3">Turmas</span>
    </a>

    <a class="{{ request()->routeIs('professor.professores.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.professores.index') }}">
      <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.043,14H7.957A4.963,4.963,0,0,0,3,18.957V24H21V18.957A4.963,4.963,0,0,0,16.043,14Z" />
        <circle cx="12" cy="6" r="6" />
      </svg>
      <span class="mx-3">Professores</span>
    </a>

    <a class="{{ request()->routeIs('professor.cursos.index') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="{{ route('professor.cursos.index') }}">
      <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M15,6.99l1.08,3.03h-2.16l1.08-3.03ZM6,18V0h-1c-1.66,0-3,1.34-3,3v15.77c.55-.49,1.26-.77,2-.77h2ZM2,22c0,1.1,.9,2,2,2H22v-4H4c-1.1,0-2,.9-2,2ZM22,2V18H8V0h12c1.1,0,2,.9,2,2Zm-2.37,12.02l-3.22-9.02c-.22-.6-.77-.99-1.41-.99s-1.19,.39-1.41,1l-3.22,9.02h2.12l.71-2h3.59l.71,2h2.12Z" />
      </svg>
      <span class="mx-3">Cursos</span>
    </a>

    <a class="{{ request()->routeIs('') ? 'bg-gray-700 bg-opacity-25' : 'hover:bg-opacity-25 hover:bg-gray-700 hover:text-gray-100' }} flex items-center px-6 py-2 py-3"
      href="">
      <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path
          d="m19.828 3.414-2.242-2.242a3.975 3.975 0 0 0 -2.829-1.172h-8.757a3 3 0 0 0 -3 3v21h18v-17.758a4.022 4.022 0 0 0 -1.172-2.828zm-1.414 1.414a1.923 1.923 0 0 1 .141.172h-2.555v-2.555a1.923 1.923 0 0 1 .172.141zm-13.414 17.172v-19a1 1 0 0 1 1-1h8v5h5v15zm2-6h10v-6h-10zm2-4h6v2h-6zm-2 6h10v2h-10z" />
      </svg>
      <span class="mx-3">Relatórios</span>
    </a>

    <a class="flex items-center px-6 py-2 py-3 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
      href="{{ route('professor.logout') }}">
      <svg class="h-7 w-7" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
        <path fill-rule="evenodd"
          d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
      </svg>
      <span class="mx-3">Sair</span>
    </a>

  </nav>
</div>
