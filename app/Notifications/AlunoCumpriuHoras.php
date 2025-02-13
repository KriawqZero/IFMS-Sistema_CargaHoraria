<?php

namespace App\Notifications;

use App\Models\Aluno;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlunoCumpriuHoras extends Notification {
    protected $aluno;

    public function __construct(Aluno $aluno) {
        $this->aluno = $aluno;
    }

    public function via(object $notifiable): array {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array {
        $aluno_url = route('professor.alunos.index', ['id' => $this->aluno->id]);
        return [
            'aluno' => true,
            'foto_src' => $this->aluno->foto_src,
            'mensagem' => "<span>O aluno <a class='font-bold text-green-400 hover:underline' href='{$aluno_url}'>{$this->aluno->nome}</a> ({$this->aluno->turma->codigo}) completou a carga horária requerida!</span>",
        ];
    }

    public function toMail(object $notifiable): MailMessage {
        $alunoUrl = route('professor.alunos.index', ['id' => $this->aluno->id]);

        return (new MailMessage)
            ->subject('[Ação Requerida] Aluno Completo de Horas')
            ->greeting("Parabéns {$notifiable->nome}!")
            ->line("O aluno **{$this->aluno->nome}** da turma **{$this->aluno->turma->codigo}** atingiu 100% da carga horária obrigatória.")
            ->line('Por favor, verifique os certificados e realize a validação final:')
            ->action('Acessar Perfil do Aluno', $alunoUrl)
            ->line('Este aluno requer atenção especial para conclusão do processo.');
    }

    public function toArray(object $notifiable): array {
        return [
            //
        ];
    }
}
