<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Professor\Curso\CursoRequest;
use App\Http\Services\Professor\CursoService;

class ProfessorCursoController extends Controller {
    public function __construct(private
        CursoService $cursoService
    ) {}

    public function index() {
        $cursos = $this->cursoService->getAllCursos();

        return view('professor.cursos.cursos', [
            'titulo' => 'Cursos',
            'cursos' => $cursos
        ]);
    }

    public function create() {
        return view('professor.cursos.create', [
            'titulo' => 'Criar Curso'
        ]);
    }

    public function store(CursoRequest $request) {
        $input = $request->validated();

        if($this->cursoService->storeCurso($input))
            return redirect()->route('professor.cursos.index')->with('success', 'Curso criado com sucesso');

        return redirect()->route('professor.cursos.index')->withErrors('Erro ao criar curso. Tente novamente mais tarde');
    }

    public function edit($id) {
        return view('professor.cursos.edit', [
            'titulo' => 'Editar Curso',
            'curso' => $this->cursoService->getCursoPorId($id)
        ]);
    }

    public function put(CursoRequest $request, $id) {
        $input = $request->validated();

        if($this->cursoService->updateCurso($id, $input))
            return redirect()->route('professor.cursos.index')->with('success', 'Curso atualizado com sucesso');

        return redirect()->route('professor.cursos.index')->withErrors('Erro ao atualizar curso. Tente novamente mais tarde');
    }

    public function destroy($id) {
        if ($this->cursoService->deleteCurso($id))
            return redirect()->route('professor.cursos.index')->with('success', 'Curso deletado com sucesso');

        return redirect()->route('professor.cursos.index')->with('info', 'Não é possível deletar curso. Desvincule todas suas turmas
            dependentes primeiro.');
    }
}
