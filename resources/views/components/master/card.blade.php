@props(['iconBg', 'titulo', 'subtitulo'])

<div {{ $attributes->merge(['class' => 'flex items-center px-5 py-6 shadow-xl rounded-3xl bg-white']) }}>
  <div class="p-3 rounded-full {{ $iconBg }}">
    {{ $slot }}
  </div>
  <div class="mx-5">
    <h4 class="text-2xl font-semibold text-gray-700">{{ $titulo }}</h4>
    <div class="text-gray-500">{{ $subtitulo }}</div>
  </div>
</div>
