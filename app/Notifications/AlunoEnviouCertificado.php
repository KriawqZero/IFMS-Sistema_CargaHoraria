<?php

namespace App\Notifications;

use App\Models\Aluno;
use App\Models\Certificado;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class AlunoEnviouCertificado extends Notification {
    use Queueable;

    protected $aluno;
    protected $certificado;

    /**
     * Create a new notification instance.
     */
    public function __construct(Aluno $aluno, Certificado $certificado) {
        $this->aluno = $aluno;
        $this->certificado = $certificado;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array
     */
    public function toDatabase(object $notifiable): array {
        $aluno_url = route('professor.alunos.index', ['id' => $this->aluno->id]);
        return [
            'aluno' => true,
            'foto_src' => $this->aluno->foto_src,
            'certificado_id' => $this->certificado->id,
            'mensagem' => "<span> O aluno <a class='font-bold text-green-400 hover:underline' href='{$aluno_url}'>{$this->aluno->nome} </a> ({$this->aluno->turma->codigo}) enviou um novo certificado</span>",
        ];
    }
}
