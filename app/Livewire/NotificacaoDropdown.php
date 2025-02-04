<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class NotificacaoDropdown extends Component {
    use WithPagination;

    protected $listeners = ['loadMore']; // Ouve o evento loadMore

    public int $limit = 5;
    public bool $loading = false;
    public $usuarioLogado;

    public function mount($usuarioLogado) {
        /** @var \App\Models\Aluno $usuarioLogado */
        $this->usuarioLogado = $usuarioLogado;
    }

    public function carregarMais() {
        $this->loading = true; // Ativa o estado de carregamento
        $this->limit += 5;
        $this->dispatch('notificationsLoaded'); // Emite evento quando carregar
        $this->loading = false; // Desativa o estado de carregamento
    }

    public function render() {
        $notifications = $this->usuarioLogado->notifications()->take($this->limit)->get();

        return view('livewire.notificacao-dropdown', [
            'notifications' => $notifications,
            'usuarioLogado' => $this->usuarioLogado,
        ]);
    }

    public function removerNotificacao($notificationId) {
        $notification = $this->usuarioLogado->notifications()->find($notificationId);
        if ($notification)
            $notification->delete();

        $this->dispatch('notificationsUpdated'); // Atualiza a lista após a remoção
    }

    public function marcarComoLida($notificationId) {
        $notification = $this->usuarioLogado->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

    }

    public function marcarTodasComoLido() {
        $this->usuarioLogado->unreadNotifications->markAsRead();
        $this->dispatch('notificationsUpdated'); // Atualiza a lista após marcar como lido
    }
}
