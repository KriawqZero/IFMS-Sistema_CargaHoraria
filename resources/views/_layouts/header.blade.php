<header class="flex items-center justify-between border-b-4 border-green-600 bg-white px-6 py-4">
  <div class="flex items-center">
    <button class=" text-gray-500 focus:outline-none lg:hidden" onclick="window.history.back()">
      <svg class="h-6 w-6" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
      </svg>
    </button>
    <button @click="sidebarOpen = true" class="ml-2 text-gray-500 focus:outline-none lg:hidden">
      <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>

    <div class="relative mx-4 lg:mx-0">
      <h4 class="text-3xl font-medium text-gray-500">{{ $titulo }}</h4>
    </div>
  </div>

  <div class="flex items-center">
    <!-- Notificações -->
    <livewire:notificacao-dropdown :usuarioLogado="$usuarioLogado" />

    <div x-data="{ dropdownOpen: false }" class="relative">
      <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2">
        <!-- Imagem de perfil -->
        <div class="relative block h-8 w-8 overflow-hidden rounded-full shadow focus:outline-none">
          <img class="h-full w-full object-cover" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}"
            alt="Foto de perfil">
        </div>
        <!-- Ícone SVG ao lado direito -->
        <svg class="h-5 w-5 text-gray-600" viewBox="0 0 16 16" fill="#9CA3AF" xmlns="http://www.w3.org/2000/svg">
          <path x-show="!dropdownOpen"
            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
          <path x-show="dropdownOpen"
            d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
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
