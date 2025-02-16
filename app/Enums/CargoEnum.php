<?php

namespace App\Enums;

enum CargoEnum: string {
    case Professor = 'professor';
    case Coordenador = 'coordenador';

    public function level(): int {
        return match ($this) {
            self::Professor => 0,
            self::Coordenador => 1,
        };
    }

    public static function format(string $cargo): string {
        return match ($cargo) {
            'professor' => 'Professor',
            'coordenador' => 'Coordenador',
            default => 'Cargo inválido',
        };
    }

    public static function fromString(string $cargo): ?self {
        return match ($cargo) {
            'professor' => self::Professor,
            'coordenador' => self::Coordenador,
            default => null,
        };
    }
}
