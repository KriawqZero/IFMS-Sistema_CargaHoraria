@extends('_layouts.master')

@section('body')
  <div class="p-4 lg:p-6 xl:p-8" x-data="profileEditor()">
    <div class="mx-auto max-w-3xl rounded-lg bg-white p-6 shadow-md">
      <form action="{{ route('perfil.update', $usuarioLogado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Seção da Foto -->
        <div class="mb-8 border-b pb-6">
          <h2 class="mb-4 text-xl font-semibold text-gray-800">Foto do Perfil</h2>
          <div class="flex items-center gap-6">
            <div class="group relative">
              <div class="h-32 w-32 overflow-hidden rounded-full border-4 border-white shadow-lg">
                <img id="previewImage" src="{{ asset('storage/' . $usuarioLogado->foto_src) }}"
                  class="h-full w-full object-cover transition-opacity duration-200 group-hover:opacity-75"
                  alt="Foto de perfil">
              </div>
              <div
                class="absolute inset-0 flex items-center justify-center rounded-full bg-black bg-opacity-50 opacity-0 transition-opacity group-hover:opacity-100">
                <span class="text-sm font-medium text-white">Alterar</span>
              </div>
            </div>
            <div class="space-y-3">
              <input type="file" name="foto" id="imageInput" class="hidden" accept="image/*"
                @change="
                     const file = $event.target.files[0];
                     if (file) {
                       const reader = new FileReader();
                       reader.onload = (e) => {
                         imageSrc = e.target.result;
                         showCropper = true;
                       };
                       reader.readAsDataURL(file);
                     }
                   ">
              <label for="imageInput"
                class="inline-block cursor-pointer rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Escolher Nova Foto
              </label>
              <!-- Modifique o botão de remover foto -->
              <!-- Campo oculto para remoção de foto -->
              <input type="hidden" name="remover_foto" id="removerFotoInput" value="0">
              <button type="button"
                onclick="
              document.getElementById('previewImage').src = '{{ asset('storage/default-profile.svg') }}';
              document.getElementById('removerFotoInput').value = '1';
              document.getElementById('imageInput').value = '';"
                class="block text-sm text-gray-600 hover:text-gray-800">
                Remover Foto
              </button>
            </div>
          </div>
        </div>

        <!-- Modal do Cropper -->
        <div x-show="showCropper" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
          x-cloak>
          <div class="w-full max-w-2xl rounded-lg bg-white p-4">
            <div class="h-96 bg-gray-100">
              <img id="cropperImage" :src="imageSrc" class="max-h-full">
            </div>
            <div class="mt-4 flex justify-end gap-3">
              <button @click="showCropper = false; document.getElementById('imageInput').value = '';"
                class="px-4 py-2 text-gray-600 hover:text-gray-800">
                Cancelar
              </button>
              <button type="button" @click="applyCrop()"
                class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">
                Aplicar Corte
              </button>
            </div>
          </div>
        </div>

        <!-- Seção de Informações -->
        <div class="mb-8 border-b pb-6">
          <h2 class="mb-4 text-xl font-semibold text-gray-800">Informações Pessoais</h2>
          <div class="grid gap-4 md:grid-cols-2">
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700">Nome Completo</label>
              <input type="text" value="{{ $usuarioLogado->nome }}" disabled
                class="w-full rounded-lg bg-gray-100 px-4 py-2 text-gray-700 disabled:opacity-75">
            </div>
            <div>
              <label class="mb-1 block text-sm font-medium text-gray-700">Email</label>
              <input type="email" value="{{ $usuarioLogado->email }}" disabled
                class="w-full rounded-lg bg-gray-100 px-4 py-2 text-gray-700 disabled:opacity-75">
            </div>
          </div>
        </div>

        @if (auth('professor')->check())
          <!-- Seção de Segurança -->
          <div class="mb-8">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Segurança</h2>
            <div class="rounded-lg bg-blue-50 p-4">
              <p class="mb-3 text-sm text-blue-800">
                Para alterar sua senha, clique no botão abaixo, será aberto uma nova página com as instruções.
              </p>
              <a href="{{ route('professor.trocarSenha') }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Redefinir Senha
              </a>
            </div>
          </div>
        @endif

        <!-- Botão de Salvar -->
        <div class="flex justify-end gap-3">
          <a href="{{ url()->previous() }}"
            class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
            Cancelar
          </a>
          <button type="submit" class="rounded-lg bg-green-600 px-6 py-2 text-white hover:bg-green-700">
            Salvar Alterações
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <!-- Scripts do Cropper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
  <script>
    function profileEditor() {
      return {
        showCropper: false,
        imageSrc: '',
        cropper: null,

        init() {
          this.$watch('showCropper', (value) => {
            if (value) {
              this.$nextTick(() => {
                const image = document.getElementById('cropperImage');
                this.cropper = new Cropper(image, {
                  aspectRatio: 1,
                  viewMode: 3,
                  autoCropArea: 1,
                  movable: false,
                  rotatable: false,
                  scalable: false,
                  zoomable: false,
                  ready: () => {
                    this.cropper.setCropBoxData({
                      width: 1024,
                      height: 1024
                    });
                  }
                });
              });
            } else if (this.cropper) {
              this.cropper.destroy();
              this.cropper = null;
            }
          });
        },


        applyCrop() {
          if (!this.cropper) return;

          const canvas = this.cropper.getCroppedCanvas({
            width: 1024,
            height: 1024,
            fillColor: '#fff',
            imageSmoothingQuality: 'high'
          });

          canvas.toBlob((blob) => {
            const file = new File([blob], 'avatar.jpg', {
              type: 'image/jpeg'
            });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);

            // Resetar o campo de remoção ao fazer novo upload
            document.getElementById('removerFotoInput').value = '0';
            document.getElementById('imageInput').files = dataTransfer.files;

            const url = URL.createObjectURL(blob);
            document.getElementById('previewImage').src = url;
            this.showCropper = false;
          }, 'image/jpeg', 0.8);
        }
      }
    }
  </script>
@endpush
