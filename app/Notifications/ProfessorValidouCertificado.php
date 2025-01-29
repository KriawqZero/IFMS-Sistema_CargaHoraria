<?php

namespace App\Notifications;

use App\Models\Certificado;
use App\Models\Professor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProfessorValidouCertificado extends Notification {
    use Queueable;

    protected $professor;
    protected $certificado;

    /**
     * Create a new notification instance.
     */
    public function __construct(Professor $professor, Certificado $certificado) {
        $this->professor = $professor;
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
        return [
            'aluno' => true,
            'foto_src' => $this->professor->foto_src,
            'certificado_id' => $this->certificado->id,
            'mensagem' => "
            O Professor <span class='font-bold text-green-400 hover:underline'>{$this->professor->nome_completo}</span>
            validou um de seus certificados",
        ];
    }
}
