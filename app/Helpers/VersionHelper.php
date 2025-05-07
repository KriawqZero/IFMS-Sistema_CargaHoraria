<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class VersionHelper {
    public static function getAllVersions() {
        try {
            $notas = json_decode(Storage::disk('public')->get('updates.json'), true);
            $notas = array_reverse($notas);
            return $notas;
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function getLatestVersion() {
        try {
            $notas = json_decode(Storage::disk('public')->get('updates.json'), true);
            return $notas[0] ?? ['version' => '1.0', 'date' => '19/02/2025'];
        } catch (\Exception $e) {
            return ['version' => '1.0', 'date' => '19/02/2025'];
        }
    }
}
