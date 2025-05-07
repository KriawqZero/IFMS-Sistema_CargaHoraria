<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class VersionHelper {
    /**
     * Obtém todas as versões do sistema
     * 
     * @return array Array com todas as versões, ordenadas da mais recente para a mais antiga
     */
    public static function getAllVersions() {
        try {
            $notas = json_decode(Storage::disk('public')->get('updates.json'), true);
            
            // Garante que as notas estejam ordenadas da mais recente para a mais antiga
            usort($notas, function($a, $b) {
                $dataA = \DateTime::createFromFormat('d/m/Y', $a['date']);
                $dataB = \DateTime::createFromFormat('d/m/Y', $b['date']);
                return $dataB <=> $dataA;
            });
            
            return $notas;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Obtém a versão mais recente do sistema
     * 
     * @return array Array com informações da versão mais recente
     */
    public static function getLatestVersion() {
        try {
            $notas = self::getAllVersions();
            return $notas[0] ?? [
                'version' => '1.0',
                'date' => '19/02/2025',
                'author' => 'Sistema',
                'changes' => [
                    [
                        'type' => 'generic',
                        'description' => 'Versão inicial do sistema'
                    ]
                ]
            ];
        } catch (\Exception $e) {
            return [
                'version' => '1.0',
                'date' => '19/02/2025',
                'author' => 'Sistema',
                'changes' => [
                    [
                        'type' => 'generic',
                        'description' => 'Versão inicial do sistema'
                    ]
                ]
            ];
        }
    }
}
