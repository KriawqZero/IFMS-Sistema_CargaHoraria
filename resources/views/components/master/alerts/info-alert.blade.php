@props(['mensagem', 'timeout'])

<div x-data="{ showInfo: 'true' }"
     x-show="showInfo"
     x-transition:enter="transition ease-out duration-300 transform"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transition ease-in duration-300 transform"
     x-transition:leave-start="translate-x-0 opacity-100"
     x-transition:leave-end="translate-x-full opacity-0"
     x-init="if (showInfo) { setTimeout(() => showInfo = false, {{ $timeout }}); }"
     class="fixed top-5 right-5 z-20 inline-flex max-w-sm w-full bg-white shadow-md rounded-lg overflow-hidden">
    <div class="flex justify-center items-center w-12 bg-blue-500">
        <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
        </svg>
    </div>

    <x-buttons::close-button data="showInfo" />

    <div class="-mx-3 py-2 px-4">
        <div class="mx-3">
            <span class="text-blue-500 font-semibold">Informação</span>
            <p class="text-gray-600 text-sm">
                {{ $mensagem }}
            </p>
        </div>
    </div>
</div>
