<x-app-layout>

    <div class=" p-2 ml-1 text-center text-lg">
        {{ $album->name }} ({{ $album->images->count() }}) / {{ $album->user->name }}
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 ">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
                        <div class="w-full p-1">
                            @if (Illuminate\Support\Facades\Auth::user()->id == $album->user_id)
                                <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false">
                                    <!-- Trigger for Modal -->
                                    <button type="button" @click="showModal = true"
                                        class="p-2 w-full block font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Image</button>
                                    @if ($album->images->count() > 0)
                                        <form style="margin-top:5%;margin-bottom:5%"
                                            action="{{ route('dashboard.album.images.destroy', $album) }}"
                                            class="d-inline" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}

                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">delete
                                                All</button>
                                        </form>
{{-- 
                                        <button type="button" @click="showModalAsign = true"
                                            class="p-2 w-full block font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Asign
                                            All Images</button>

                                        <!-- Trigger for Modal -->

                                        <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                            x-show="showModalAsign">
                                            <!-- Modal inner -->

                                            <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                                                @click.away="showModalAsign = false">

                                                <div class="w-full max-w-xs">
                                                    <form class="bg-white roundedmb-4"
                                                        action="{{ route('dashboard.album.images.asign', $album) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <input type="hidden" name="album_id"
                                                            value="{{ $album->id }}">
                                                        <div class="mb-4">
                                                            <label class="block text-gray-700 text-sm font-bold mb-2"
                                                                for="name">
                                                                album _name
                                                            </label>
                                                            <select id="album_id" name="album_id"
                                                                class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                                @foreach (auth()->user()->albums()->where('id', '!=', $album->id)->get() as $album)
                                                                    <option value="{{ $album->id }}">
                                                                        {{ $album->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="flex items-center justify-between">
                                                            <button
                                                                class="bg-amber-700 hover:bg-amber-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                                type="submit">
                                                                Asign
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div> --}}
                                





                            @endif
                            <!-- Fon -->
                            <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                x-show="showModal">
                                <!-- Modal inner -->
                                <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                                    @click.away="showModal = false">

                                    <div class="w-full max-w-xs">
                                        <form class="bg-white roundedmb-4"
                                            action="{{ route('dashboard.image.store', $album) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="album_id" value="{{ $album->id }}">
                                            <div class="mb-4">
                                                <label class="block text-gray-700 text-sm font-bold mb-2"
                                                    for="name">
                                                    Name
                                                </label>
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="name" name="name" type="text"
                                                    placeholder="Photo name" required>
                                            </div>
                                            <div class="mb-4">
                                                <input
                                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                    id="picture1" name="picture1" type="file" placeholder="picture" required>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <button
                                                    class="bg-amber-700 hover:bg-amber-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                    type="submit">
                                                    Add
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        @endif
                    </div>
                    @include('images.index')
                  
                </div>
               
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
