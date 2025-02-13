<header class="flex items-center justify-between border-b-4 border-green-600 bg-white px-4 py-3 sm:px-6 sm:py-4">
  <div class="flex items-center flex-1 min-w-0">
    <!-- Botões mobile -->
    <div class="flex items-center lg:hidden">
      <button class="text-gray-500 focus:outline-none" onclick="window.history.back()">
        <svg class="h-6 w-6" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
      </button>
      <button @click="sidebarOpen = true" class="ml-2 text-gray-500 focus:outline-none">
        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>

    <!-- Título -->
    <div class="relative mx-2 lg:mx-4 min-w-0">
      <h4 class="text-lg font-medium text-gray-500 truncate sm:text-xl lg:text-3xl">
        {{ $titulo }}
      </h4>
    </div>
  </div>

  <div class="flex items-center space-x-2 sm:space-x-4">
    <!-- Botão de Feedback ajustado -->
    <a href="{{ route('reports.index') }}" 
       class="mr-2 md:mr-4 flex items-center rounded-md bg-green-50 px-2 py-1.5 sm:px-3 sm:py-2 text-sm font-medium text-green-700 hover:bg-green-100 transition-colors">
      <svg class="h-4 w-4 sm:h-5 sm:w-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <span class="hidden sm:inline">Viu um bug? Tem uma sugestão?</span>
      <span class="sm:hidden">Reportar</span>
    </a>

    <!-- Notificações -->
    <div class="flex-shrink-0">
      <livewire:notificacao-dropdown :usuarioLogado="$usuarioLogado" />
    </div>

    <!-- Menu do usuário -->
    <div x-data="{ dropdownOpen: false }" class="relative flex-shrink-0">
      <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-1 sm:space-x-2">
        <div class="relative block h-7 w-7 sm:h-8 sm:w-8 overflow-hidden rounded-full shadow">
          <img class="h-full w-full object-cover" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}" alt="Foto de perfil">
        </div>
        <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-600" viewBox="0 0 16 16" fill="#9CA3AF" xmlns="http://www.w3.org/2000/svg">
          <path x-show="!dropdownOpen" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          <path x-show="dropdownOpen" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
        </svg>
      </button>

      <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 h-full w-full">
      </div>

      <div x-cloak x-show="dropdownOpen"
        class="absolute right-0 z-10 mt-2 w-48 overflow-hidden rounded-md bg-white shadow-xl">
        <a href="{{ route('perfil.index') }}"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Perfil</a>
        @if (auth('professor')->check())
          <a href="{{ route('professor.trocarSenha') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Trocar Senha</a>
          <a href="{{ route('professor.logout') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Sair</a>
        @else
          <a href="{{ route('aluno.certificados.index') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Certificados</a>
          <a href="{{ route('aluno.logout') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Sair</a>
        @endif
      </div>
    </div>
  </div>
</header>
