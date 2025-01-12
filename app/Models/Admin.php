<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model implements AuthenticatableContract {
    use HasFactory, Authenticatable;

    protected $table = 'admins';

    protected $fillable = [
        'nome',
        'login',
        'senha',
        'is_superadmin'
    ];

    protected $username = 'login';

    protected $hidden = [
        'senha',
    ];

    public function isSuperAdmin() {
        return $this->is_superadmin;
    }
}
