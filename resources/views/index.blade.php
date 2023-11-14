<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex flex-row">
                    <form method="post" action="{{ route('dashboard.album.store') }}" class="w-full">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Album title
                            </label>
                            <input type="text" required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" placeholder="Enter album title" name="name" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">
                                Description
                            </label>
                            <textarea required
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="body" placeholder="Enter album description" name="body"></textarea>
                        </div>
                        <button type="submit"
                            class="p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add New
                        </button>
                    </form>
                </div>
                @if ($albums->count() > 0)
                <div class="w-full p-6 lg:p-8">
                    <table class="table-auto w-full bg-white border" style=" border: 1px solid black;">
                        <thead class="w-full">
                            <tr style=" border: 2px solid black;">
                                <th>Album title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="w-full">
                            @foreach ($albums as $album)
                                <tr style=" border: 1px dashed black;">
                                    <td class="text-left" style="text-align: center">
                                        <div class="w-full p-1 flex items-center justify-center">
                                        <a href="{{ route('dashboard.album.show',$album) }}"
                                        class="w-[80%] p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 rounded-lg ">
                                            {{ $album->name }} ({{ $album->images->count() }})
                                        </a>
                                        </div>
                                    </td>
                                    <td class="text-right" style="text-align: center">

                                        @if ($album->images->count() > 0)


                                        <a style="display: inline" href="{{ route('dashboard.album.edit', $album) }}"  class="p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">edit</a>

                                            <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                                                <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Delete
                                                </div>
                                                <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                                    <div
                                                        class="absolute top-0 z-10 w-72 p-2 -mt-1 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-orange-500 rounded-lg shadow-lg">
                                                        The album contains images. <br />
                                                        You need to remove them first.
                                                    </div>
                                                    <svg class="absolute z-10 w-6 h-6 text-orange-500 transform -translate-x-12 -translate-y-3 fill-current stroke-current"
                                                        width="8" height="8">
                                                        <rect x="12" y="-10" width="8" height="8"
                                                            transform="rotate(45)" />
                                                    </svg>
                                                </div>
                                            </div>
                                        @else
                                            {{-- <a href="{{asset('album/'.$album->id.'/delete')}}" class="text-amber-900 hover:underline m-2">delete</a> --}}

                                            <a style="display: inline" href="{{ route('dashboard.album.edit', $album) }}"  class="p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">edit</a>



                                                
                                            <form  style="display: inline" action="{{ route('dashboard.album.destroy', $album) }}"
                                                class="d-inline" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">delete</button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                <div class="w-full p-6 lg:p-8">
                    
                        <div class="alert alert-warning text-center">
                            No albums to be seen
                        </div>
                    
                </div>

            @endif
            </div>
        </div>
    </div>
</x-app-layout>
