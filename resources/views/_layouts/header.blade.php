<header class="bg-white flex items-center justify-between px-6 py-4 border-b-4 border-green-600">
  <div class="flex items-center">
    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
      <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>

    <div class="relative mx-4 lg:mx-0">
      <h4 class="text-gray-500 text-3xl font-medium">{{ $titulo }}</h4>
    </div>
  </div>

  <div class="flex items-center">
    <!-- Notificações -->
    <livewire:notificacao-dropdown :usuarioLogado="$usuarioLogado"/>

    <div x-data="{ dropdownOpen: false }" class="relative">
      <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2">
        <!-- Imagem de perfil -->
        <div class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
          <img class="object-cover w-full h-full" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}" alt="Foto de perfil">
        </div>
        <!-- Ícone SVG ao lado direito -->
        <svg class="w-5 h-5 text-gray-600" viewBox="0 0 16 16" fill="#9CA3AF" xmlns="http://www.w3.org/2000/svg">
          <path x-show="!dropdownOpen" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
          <path x-show="dropdownOpen" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
        </svg>
      </button>

      <div x-cloak x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 z-10 w-full h-full">
      </div>

      <div x-cloak x-show="dropdownOpen"
        class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
          <a href="{{ route('perfil.index') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Perfil</a>
        @if(auth('professor')->check())
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
