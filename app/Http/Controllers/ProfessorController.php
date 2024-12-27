<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessorController extends Controller {
    public function showLoginForm() {
        return view('professor/login');
    }
}
