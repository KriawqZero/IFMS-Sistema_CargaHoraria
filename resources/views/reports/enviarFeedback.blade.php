@extends('_layouts.master')

@section('body')
  <div class="lg:pb-12 lg:pl-12 lg:pr-12">
    <div class="z-10 w-full rounded-3xl bg-white p-9 shadow-2xl sm:max-w-none lg:max-w-full">
      <div>
        <h3 class="mt-5 text-3xl font-bold text-gray-900">
          Novo Feedback
        </h3>
      </div>

      <form class="mt-8 space-y-6" action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <!-- Tipo (Obrigatório) -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Tipo <span class="text-red-500">*</span>
            </label>
            <select name="tipo" required class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm"
              x-data="{ tipo: '{{ old('tipo') }}' }" x-model="tipo" @change="tipo = $event.target.value">
              <option value="">Selecione o tipo</option>
              <option value="bug">Bug</option>
              <option value="sugestao">Sugestão</option>
            </select>
          </div>

          <!-- Email (Obrigatório) -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Email <span class="text-red-500">*</span>
            </label>
            <input type="email" name="emailUsuario" value="{{ old('emailUsuario') }}" required
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
          </div>

          <!-- Descrição (Obrigatório) -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">
              Descrição <span class="text-red-500">*</span>
            </label>
            <textarea name="descricao" required rows="4"
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">{{ old('descricao') }}</textarea>
          </div>

          <!-- Anexos -->
          <div class="md:col-span-2" x-data="fileUpload()">
            <label class="block text-sm font-medium text-gray-700">
              Anexos (Máximo 10 arquivos)
            </label>

            <input type="file" name="anexos[]" multiple class="hidden" x-ref="fileInput" @change="handleFileSelect">

            <button type="button" @click="$refs.fileInput.click()"
              class="mt-2 flex items-center rounded-md border border-dashed border-gray-300 px-4 py-2 text-gray-600 hover:border-gray-400">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Adicionar arquivos
            </button>

            <div class="mt-4 space-y-3">
              <template x-for="(file, index) in files" :key="index">
                <div class="flex items-center justify-between rounded-lg bg-gray-50 p-3 shadow-sm">
                  <div class="flex items-center space-x-3">
                    <template x-if="file.type.startsWith('image/')">
                      <img :src="file.preview" class="h-12 w-12 rounded object-cover">
                    </template>
                    <template x-if="!file.type.startsWith('image/')">
                      <div class="flex h-12 w-12 items-center justify-center rounded bg-gray-200">
                        <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                      </div>
                    </template>

                    <div>
                      <div class="text-sm font-medium text-gray-900" x-text="file.name"></div>
                      <div class="text-sm text-gray-500" x-text="formatFileSize(file.size)"></div>
                    </div>
                  </div>

                  <div class="flex items-center space-x-2">
                    <div x-show="file.uploading" class="text-blue-500">
                      <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                          stroke-width="4" />
                        <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                      </svg>
                    </div>
                    <button type="button" @click="removeFile(index)" class="text-red-500 hover:text-red-700">
                      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </template>
            </div>

            <div class="mt-2 text-sm text-gray-500" x-text="`${files.length}/10 arquivos selecionados`"></div>
          </div>

          <!-- Outros campos -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Navegador</label>
            <input type="text" name="navegador" value="{{ old('navegador') }}"
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Sistema Operacional</label>
            <input type="text" name="sistemaOperacional" value="{{ old('sistemaOperacional') }}"
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">
          </div>

          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">Passos para Reprodução</label>
            <textarea name="passosReproducao" rows="3"
              class="mt-1 block w-full rounded-md border border-gray-300 p-2 shadow-sm">{{ old('passosReproducao') }}</textarea>
          </div>
        </div>

        <div class="flex gap-4">
          <button type="submit" class="rounded bg-green-500 px-4 py-2 text-white hover:bg-green-600">
            Enviar Feedback
          </button>
          <a href="{{ url()->previous() }}" class="rounded bg-gray-300 px-4 py-2 hover:bg-gray-400">
            Cancelar
          </a>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('fileUpload', () => ({
        files: [],

        handleFileSelect(event) {
          const existingFiles = this.files.map(f => f.file);
          const newFiles = Array.from(event.target.files)
            .slice(0, 10 - this.files.length);

          // Combinar arquivos existentes com novos
          const combinedFiles = [...existingFiles, ...newFiles];

          // Atualizar o input real com DataTransfer
          const dataTransfer = new DataTransfer();
          combinedFiles.forEach(file => dataTransfer.items.add(file));
          this.$refs.fileInput.files = dataTransfer.files;

          // Atualizar estado do Alpine
          this.files = combinedFiles.map(file => ({
            file,
            name: file.name,
            size: file.size,
            type: file.type,
            preview: file.type.startsWith('image/') ? URL.createObjectURL(file) : null,
            uploading: false
          }));
        },

        removeFile(index) {
          // Remover do array Alpine
          this.files.splice(index, 1);

          // Atualizar input real com DataTransfer
          const dataTransfer = new DataTransfer();
          this.files.forEach(f => dataTransfer.items.add(f.file));
          this.$refs.fileInput.files = dataTransfer.files;
        },

        formatFileSize(bytes) {
          if (bytes === 0) return '0 Bytes';
          const k = 1024;
          const sizes = ['Bytes', 'KB', 'MB', 'GB'];
          const i = Math.floor(Math.log(bytes) / Math.log(k));
          return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
      }));
    });
  </script>
@endpush
