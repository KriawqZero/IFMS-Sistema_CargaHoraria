<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;


class NotificacaoDropdown extends Component {
     use WithPagination;

    protected $paginationTheme = 'tailwind'; // Estilização de paginação

    protected $listeners = ['loadMore']; // Ouve o evento loadMore

    public int $limit = 5;
    public bool $loading = false;
    public $usuarioLogado;

    public function mount($usuarioLogado) {
        /** @var \App\Models\Aluno $usuarioLogado */
        $this->usuarioLogado = $usuarioLogado;
    }

    public function loadMore() {
        $this->loading = true; // Ativa o estado de carregamento
        $this->limit += 5;
        $this->dispatch('notificationsLoaded'); // Emite evento quando carregar
        $this->loading = false; // Desativa o estado de carregamento
    }

    public function removeNotification($notificationId) {
        $notification = $this->usuarioLogado->notifications()->find($notificationId);
        if ($notification) {
            $notification->delete();
            session()->flash('success', 'Notificação removida com sucesso.');
        } else {
            session()->flash('error', 'Falha ao remover a notificação.');
        }
        $this->dispatch('notificationsUpdated'); // Atualiza a lista após a remoção
    }



    public function render() {
        $notifications = $this->usuarioLogado->notifications()->take($this->limit)->get();

        return view('livewire.notificacao-dropdown', [
            'notifications' => $notifications,
            'usuarioLogado' => $this->usuarioLogado,
        ]);
    }

    public function markAsRead($notificationId) {
        $notification = $this->usuarioLogado->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }
    }
}
