@props(['data'])

<button @click="{{ $data }} = false" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-800">
  <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path
      d="M10 8.586l4.95-4.95 1.414 1.414L11.414 10l4.95 4.95-1.414 1.414L10 11.414l-4.95 4.95-1.414-1.414L8.586 10 3.636 5.05 5.05 3.636 10 8.586z" />
  </svg>
</button>
