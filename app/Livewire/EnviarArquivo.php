<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class EnviarArquivo extends Component {
    use WithFileUploads;

    public $isDragging = false;
    public $file;
    public $fileName;
    public $uploadSuccess = false;

    public function updatedFile()
    {
        $this->fileName = $this->file->getClientOriginalName();
        $this->uploadSuccess = true;

        // Aqui você pode salvar o arquivo no servidor, se necessário
        /*$this->file->store('uploads');*/
    }


    public function render()
    {
        return view('livewire.enviar-arquivo');
    }
}
