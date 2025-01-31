<?php
namespace App\Http\Services\Professor;

use App\Models\Professor;

class NotificacaoService {
    public function markCertificadoNotificationsAsRead(Professor $professor, int $certificadoId): void {
        $professor->notifications()
            ->where('data->certificado_id', $certificadoId)
            ->get()
            ->markAsRead();
    }
}
