@extends('_layouts.master')

@section('body')
    <div class="sm:max-w-none w-full max-w-full p-9 bg-white rounded-3xl z-10">
        <div class="text-center">
            <h3 class="mt-5 text-3xl font-bold text-gray-900">
                File Upload!
                </h2>
                <p class="mt-2 text-sm text-gray-400">Lorem ipsum is placeholder text.</p>
        </div>
        <form class="mt-8 space-y-3" action="#" method="POST">
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
                <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                    type="" placeholder="mail@gmail.com">
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
                <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                    type="" placeholder="mail@gmail.com">
            </div>
            <div class="grid grid-cols-1 space-y-2">
                <label class="text-sm font-bold text-gray-500 tracking-wide">Anexar documento</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                        <div class="h-full w-full flex flex-col items-center justify-center">
                            <div class="flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-36 h-36 text-zinc-500 bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z" />
                                    <path fill-rule="evenodd"
                                        d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z" />
                                </svg>
                            </div>
                            <p class="pointer-none text-gray-500 mt-4">
                                <span class="text-sm">Drag and drop</span> files here <br />
                                or <a href="#" class="text-blue-600 hover:underline">select a file</a> from your
                                computer
                            </p>
                        </div>
                        <input type="file" class="hidden">
                    </label>
                </div>
            </div>
            <p class="text-sm text-gray-300">
                <span>File type: doc,pdf,types of images</span>
            </p>
            <div>
                <button type="submit"
                    class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                            font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                    Upload
                </button>
            </div>
        </form>
    </div>
@endsection
