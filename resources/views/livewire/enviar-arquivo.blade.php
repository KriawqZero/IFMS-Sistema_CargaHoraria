<div
    class="flex items-center justify-center w-full"
    x-data="{ dragging: @entangle('isDragging') }"
    x-on:dragenter.prevent="dragging = true"
    x-on:dragleave.prevent="dragging = false"
    x-on:dragover.prevent="dragging = true"
    x-on:drop.prevent="dragging = false">
    <label
        class="flex flex-col rounded-lg border-4 w-full h-60 p-10 group text-center"
        :class="{ 'border-blue-500 bg-blue-50': dragging, 'border-dashed text-gray-500': !dragging }">
        <div class="h-full w-full flex flex-col items-center justify-center">
            <div class="flex justify-center items-center">
                <template x-if="!@entangle('uploadSuccess')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="w-36 h-36 bi bi-box-arrow-in-up"
                        :class="{ 'text-blue-500': dragging, 'text-gray-500': !dragging }"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z" />
                        <path fill-rule="evenodd"
                            d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                    </svg>
                </template>
                <template x-if="@entangle('uploadSuccess')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="w-36 h-36 bi bi-check-circle-fill text-green-500" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.5 11.5l-3-3 1.415-1.415L6.5 8.672l4.085-4.085L12 5.5l-5.5 6z"/>
                    </svg>
                </template>
            </div>
            <p class="pointer-none mt-4">
                <template x-if="!@entangle('uploadSuccess')">
                    <span class="text-sm">Drag and drop</span> files here <br />
                    or <a href="#" class="text-blue-600 hover:underline">select a file</a> from your computer
                </template>
                <template x-if="@entangle('uploadSuccess')">
                    <span class="text-sm text-green-500">File uploaded successfully:</span>
                    <br />
                    <span class="text-gray-700">@entangle('fileName')</span>
                </template>
            </p>
        </div>
        <input type="file" class="hidden" x-on:change="$wire.upload('file', $event.target.files[0])">
    </label>
</div>

