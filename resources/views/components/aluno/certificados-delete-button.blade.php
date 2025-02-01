@props(['certificadoId'])

<div x-data="{ showModal: false, certificadoId: null }">
  <!-- Botão de exclusão -->
  <a href="javascript:void(0)" class="text-red-500 hover:text-red-800"
    @click.prevent="showModal = true; certificadoId = {{ $certificadoId }}">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash h-6 w-6" viewBox="0 0 16 16">
      <path
        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
      <path
        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
    </svg>
  </a>
  <!-- Modal de exclusão -->
  <div x-show="showModal"
    class="fixed inset-0 flex h-full w-full items-center justify-center overflow-y-auto bg-gray-600 bg-opacity-50">
    <div @click.away="showModal = false" class="w-11/12 rounded-lg bg-white p-6 shadow-lg md:w-1/3">
      <h2 class="mb-4 text-lg font-semibold text-gray-700">Tem certeza que deseja excluir este certificado?</h2>
      <div class="flex justify-end space-x-2">
        <button @click="showModal = false"
          class="rounded bg-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-400">Cancelar</button>
        <form :action="`/aluno/certificados/delete/${certificadoId}`" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>
