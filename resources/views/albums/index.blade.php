<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200  flex-row">

                    @if ($albums->count() > 0)
                        <div class="py-12">
                            @foreach ($albums as $album)
                                <div class="py-3">

                                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                        <div class="w-full p-1 flex items-center justify-center">
                                            <a href="{{ route('dashboard.album.show', $album) }}"
                                                class="w-[80%] p-2 ml-1  font-medium text-white text-center bg-amber-600 hover:bg-amber-800 rounded-lg ">
                                                {{ $album->name }} ({{ $album->images->count() }}) /
                                                {{ $album->user->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-warning text-center">
                                    No albums to be seen
                                </div>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
