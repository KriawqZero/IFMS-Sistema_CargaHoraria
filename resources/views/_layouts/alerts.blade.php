<!-- Erro -->
<div x-data="{ showError: {{ $errors->any() ? 'true' : 'false' }} }" x-show="showError" x-transition:enter="transition ease-out duration-300 transform"
  x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
  x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0 opacity-100"
  x-transition:leave-end="translate-x-full opacity-0" x-init="if (showError) { setTimeout(() => showError = false, 10000); }"
  class="fixed right-5 top-5 z-20 inline-flex w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-md">
  <div class="flex w-12 items-center justify-center bg-red-500">
    <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708" />
    </svg>
  </div>
  <div class="-mx-3 px-4 py-2">
    <div class="mx-3">
      <span class="font-semibold text-red-500">Erro</span>
      <p class="text-sm text-gray-600">
        {{ $errors->first() }}
      </p>
    </div>
  </div>
</div>

<!-- Sucesso -->
<div x-data="{ showSuccess: {{ session('success') ? 'true' : 'false' }} }" x-show="showSuccess" x-transition:enter="transition ease-out duration-300 transform"
  x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
  x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0 opacity-100"
  x-transition:leave-end="translate-x-full opacity-0" x-init="if (showSuccess) { setTimeout(() => showSuccess = false, 10000); }"
  class="fixed right-5 top-5 z-20 inline-flex w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-md">
  <div class="flex w-12 items-center justify-center bg-green-500">
    <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z" />
    </svg>
  </div>
  <div class="-mx-3 px-4 py-2">
    <div class="mx-3">
      <span class="font-semibold text-green-500">Successo</span>
      <p class="text-sm text-gray-600">
        {{ session('success') }}
      </p>
    </div>
  </div>
</div>

<!-- Informação -->
<div x-data="{ showInfo: {{ session('info') ? 'true' : 'false' }} }" x-show="showInfo" x-transition:enter="transition ease-out duration-300 transform"
  x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
  x-transition:leave="transition ease-in duration-300 transform" x-transition:leave-start="translate-x-0 opacity-100"
  x-transition:leave-end="translate-x-full opacity-0" x-init="if (showInfo) { setTimeout(() => showInfo = false, 10000); }"
  class="fixed right-5 top-5 z-20 inline-flex w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-md">
  <div class="flex w-12 items-center justify-center bg-blue-500">
    <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z" />
    </svg>
  </div>
  <div class="-mx-3 px-4 py-2">
    <div class="mx-3">
      <span class="font-semibold text-blue-500">Info</span>
      <p class="text-sm text-gray-600">
        {{ session('info') }}
      </p>
    </div>
  </div>
</div>
