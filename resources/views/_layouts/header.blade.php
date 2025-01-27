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
    <div x-data="{ notificationOpen: false }" class="relative">
      <button @click="notificationOpen = ! notificationOpen" class="flex mx-4 text-gray-400 focus:outline-none">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <!-- Badge -->
        @if($usuarioLogado->unreadNotifications->count() > 0)
          <span
            class="absolute top-0 right-0 -translate-y-1/2 bg-red-600 text-white text-xs font-bold rounded-full px-2"
          >
            @if($usuarioLogado->unreadNotifications->count() > 9)
              9+
            @else
              {{ $usuarioLogado->unreadNotifications->count() }}
            @endif
          </span>
        @endif
      </button>

      <div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 w-full h-full">
      </div>

      <div x-cloak x-show="notificationOpen"
        class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80" style="width:20rem;">
        @forelse($usuarioLogado->notifications as $notificacao)
          @php
            if($notificacao->data['aluno']) {
              $id =  $notificacao->data['certificado_id'];
              $url = route('professor.certificados.index');
            } else {
              $url = '';
            }
          @endphp
          <form action="{{ $url }}" method="GET" class="flex items-center px-4 py-3 -mx-2">
            @if(isset($id))
              <input name="id" type="hidden" value={{$id}}>
            @endif
            <button type="submit" class="flex items-center w-full text-left px-4 py-3 -mx-2
              {{ $notificacao->read_at != null ? 'bg-gray-200 hover:bg-stone-100' : 'bg-white hover:bg-green-200' }}
              text-gray-600">
              <img class="object-cover w-8 h-8 mx-1 rounded-full" src="{{ asset('storage/' . $notificacao->data['foto_src']) }}" alt="avatar">
              <p class="mx-2 text-sm">
                {!! $notificacao->data['mensagem'] !!}
                <small class="text-gray-400 font-xs">
                  . {{ $notificacao->created_at->diffForHumans() }}
                </small>
              </p>
              </button>
          </form>
        @empty
          <a href="#" class="flex items>center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-300">
            <p class="mx-2 text-sm">
              Nenhuma notificação
            </p>
          </a>
        @endforelse
      </div>
    </div>

    <div x-data="{ dropdownOpen: false }" class="relative">
      <button @click="dropdownOpen = ! dropdownOpen" class="flex items-center space-x-2">
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
