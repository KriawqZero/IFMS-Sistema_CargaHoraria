
<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
  class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed bg-slate-800 inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
  <div class="flex items-center justify-center mt-8">
    <div class="flex items-center">
      <img href="{{ route('admin.dashboard') }}" class="mt-5 px-6" src="{{ asset('images/SISCO_1.png') }}" />
    </div>
  </div>

</div>
