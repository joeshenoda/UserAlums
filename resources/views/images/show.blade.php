<x-app-layout>


    <div class=" p-2 ml-1 text-center text-lg">
        <a href="{{ asset('album/' . $image->album_id) }}"
            class="text-amber-900 hover:underline">{{ $image->album->name }}</a> /
        {{ $image->name }}
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 ">
                    <div class="w-full p-1 flex items-center justify-center">
                        <div class="">
                            @if ($image->user_id == auth()->user()->id)
                                <form style="margin-top:5%" action="{{ route('dashboard.image.destroy', $image) }}"
                                    class="d-inline" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="float-right text-3xl m-2">&times; </button>
                                </form>
                            @endif
                            <img class="object-cover rounded-tl-lg rounded-tr-lg"
                                src="{{ asset('storage/albums/' . $image->album_id .  '/s_' . $image->picture) }}" />


                                @if ($image->user_id == auth()->user()->id)
                                <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" style="margin-top:5%">
                                    <button type="button" @click="showModal = true"
                                        class="p-2 w-full block font-medium text-white text-center bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-blue-300  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">asign
                                        to another Album</button>
                                    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
                                        x-show="showModal">
                                        <!-- Modal inner -->
                                        <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
                                            @click.away="showModal = false">
                
                                            <div class="w-full max-w-xs">
                                                <form class="bg-white roundedmb-4" action="{{ route('dashboard.image.asign', $image) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                
                                    
                                                    <div class="mb-4">
                                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                                            album name
                                                        </label>
                                                        <select id="album_id" name="album_id" required
                                                            class="shadow appearance-none border rounded w-full py-1 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                                @foreach(auth()->user()->albums()->where('id','!=',$image->album->id)->get() as $album)
                                                                <option value="{{$album->id}}">{{$album->name}}</option>
                
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
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
