<div wire:poll.10s wire:poll.keep-alive x-data="{ notificationOpen: false }" class="relative">
  <button @click="notificationOpen = !notificationOpen" class="mx-4 flex text-gray-400 focus:outline-none">
    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <!-- Badge -->
    @if ($usuarioLogado->unreadNotifications->count() > 0)
      <span class="absolute right-0 top-0 -translate-y-1/2 rounded-full bg-red-600 px-2 text-xs font-bold text-white">
        {{ $usuarioLogado->unreadNotifications->count() > 9 ? '9+' : $usuarioLogado->unreadNotifications->count() }}
      </span>
    @endif
  </button>

  <div x-cloak x-show="notificationOpen" @click="notificationOpen = false" class="fixed inset-0 z-10 h-full w-full">
  </div>

  <div x-cloak x-show="notificationOpen"
    class="absolute right-0 z-10 mt-2 w-80 overflow-hidden rounded-lg bg-white shadow-xl"
    style="max-height: 30rem; overflow-y: auto;">
    <div class="flex items-center justify-between bg-green-50 px-4 py-3 shadow">
      <h3 class="text-sm font-medium text-green-800">Notificações</h3>
      @if ($usuarioLogado->unreadNotifications->count() > 0)
        <button wire:click="markAllAsRead" class="text-green-500 transition hover:underline focus:outline-none">Marcar
          todas como lidas</button>
      @endif
    </div>
    @forelse($notifications as $notification)
      <div
        class="group flex items-center justify-between rounded-lg bg-white px-4 py-3 shadow ring-green-300 transition hover:shadow-md hover:ring-2">
        @php
          if (isset($notification->data['aluno'])) {
              $id = $notification->data['certificado_id'];
              $url = route('professor.certificados.index');
          } elseif (isset($notification->data['professor'])) {
              $id = $notification->data['certificado_id'];
              $url = route('aluno.certificados.index');
          } else {
              $url = '#';
          }
        @endphp
        <!-- Form que cobre toda a área clicável -->
        <form action="{{ $url }}" method="GET" class="flex w-full cursor-pointer items-center">
          @if (isset($id))
            <input name="id" type="hidden" value={{ $id }}>
            <input name="status" type="hidden" value="todos">
          @endif
          <button type="submit"
            class="{{ $notification->read_at ? 'bg-gray-100 hover:bg-gray-200' : 'bg-green-50 hover:bg-green-100' }} flex w-full items-center space-x-3 rounded-lg px-4 py-3 text-left transition">
            <!-- Imagem do usuário -->
            <img class="h-10 w-10 rounded-full object-cover"
              src="{{ asset('storage/' . $notification->data['foto_src']) }}" alt="avatar">

            <!-- Texto da notificação -->
            <div class="flex flex-col">
              <p class="text-sm font-medium text-gray-800">{!! $notification->data['mensagem'] !!}</p>
              <small class="font-light text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
            </div>
          </button>
        </form>

        <!-- Botão de Remover -->
        <button wire:click="removeNotification('{{ $notification->id }}')"
          wire:confirm="Tem certeza que deseja excluir esta notificação?"
          class="ml-4 rounded-lg p-2 text-red-500 transition hover:bg-red-200">
          <svg class="h-6 w-6" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M5.5 5.5C5.63261 5.5 5.75979 5.55268 5.85355 5.64645C5.94732 5.74021 6 5.86739 6 6V12C6 12.1326 5.94732 12.2598 5.85355 12.3536C5.75979 12.4473 5.63261 12.5 5.5 12.5C5.36739 12.5 5.24021 12.4473 5.14645 12.3536C5.05268 12.2598 5 12.1326 5 12V6C5 5.86739 5.05268 5.74021 5.14645 5.64645C5.24021 5.55268 5.36739 5.5 5.5 5.5ZM8 5.5C8.13261 5.5 8.25979 5.55268 8.35355 5.64645C8.44732 5.74021 8.5 5.86739 8.5 6V12C8.5 12.1326 8.44732 12.2598 8.35355 12.3536C8.25979 12.4473 8.13261 12.5 8 12.5C7.86739 12.5 7.74021 12.4473 7.64645 12.3536C7.55268 12.2598 7.5 12.1326 7.5 12V6C7.5 5.86739 7.55268 5.74021 7.64645 5.64645C7.74021 5.55268 7.86739 5.5 8 5.5ZM11 6C11 5.86739 10.9473 5.74021 10.8536 5.64645C10.7598 5.55268 10.6326 5.5 10.5 5.5C10.3674 5.5 10.2402 5.55268 10.1464 5.64645C10.0527 5.74021 10 5.86739 10 6V12C10 12.1326 10.0527 12.2598 10.1464 12.3536C10.2402 12.4473 10.3674 12.5 10.5 12.5C10.6326 12.5 10.7598 12.4473 10.8536 12.3536C10.9473 12.2598 11 12.1326 11 12V6Z"
              fill="#FF0000" />
            <path
              d="M14.5 3C14.5 3.26522 14.3946 3.51957 14.2071 3.70711C14.0196 3.89464 13.7652 4 13.5 4H13V13C13 13.5304 12.7893 14.0391 12.4142 14.4142C12.0391 14.7893 11.5304 15 11 15H5C4.46957 15 3.96086 14.7893 3.58579 14.4142C3.21071 14.0391 3 13.5304 3 13V4H2.5C2.23478 4 1.98043 3.89464 1.79289 3.70711C1.60536 3.51957 1.5 3.26522 1.5 3V2C1.5 1.73478 1.60536 1.48043 1.79289 1.29289C1.98043 1.10536 2.23478 1 2.5 1H6C6 0.734784 6.10536 0.48043 6.29289 0.292893C6.48043 0.105357 6.73478 0 7 0L9 0C9.26522 0 9.51957 0.105357 9.70711 0.292893C9.89464 0.48043 10 0.734784 10 1H13.5C13.7652 1 14.0196 1.10536 14.2071 1.29289C14.3946 1.48043 14.5 1.73478 14.5 2V3ZM4.118 4L4 4.059V13C4 13.2652 4.10536 13.5196 4.29289 13.7071C4.48043 13.8946 4.73478 14 5 14H11C11.2652 14 11.5196 13.8946 11.7071 13.7071C11.8946 13.5196 12 13.2652 12 13V4.059L11.882 4H4.118ZM2.5 3H13.5V2H2.5V3Z"
              fill="#FF0000" />
          </svg>
        </button>
      </div>
    @empty
      <div class="flex items-center rounded-lg bg-gray-50 px-4 py-3 text-gray-600 shadow">
        <p class="text-sm">Nenhuma notificação</p>
      </div>
    @endforelse

    <!-- Botão Carregar Mais com Animação -->
    <div class="px-4 py-2 text-center">
      @if ($notifications->count() >= $this->limit)
        <div wire:loading>
          <div class="flex justify-center">
            <svg class="h-6 w-6 animate-spin text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24">
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 100 8H4z"></path>
            </svg>
          </div>
        </div>
        <button wire:click="loadMore" wire:loading.remove class="text-green-500 hover:underline">
          Carregar mais
        </button>
      @endif
    </div>
  </div>
</div>
