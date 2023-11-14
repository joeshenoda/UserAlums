<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Actions\Imag;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{



    public function allAlbums()
    {
        $albums = Album::orderBy('id', 'DESC')->get();
        return view('albums.index')->with('albums', $albums);
    }

    public function myAlbums()
    {
        $albums = auth()->user()->albums;
        return view('index')->with('albums', $albums);
    }
    public function show(Album $album)
    {
        return view('albums.show',)->with('album', $album);
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:albums,name'],
            'body' => ['required', 'string'],
        ]);
        $album = Album::create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => optional(Auth::user())->id
        ]);
        return redirect()->back();
    }


    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->back();
    }


    public function edit(Album $album)
    {
        return view('albums.edit')->with('album', $album);
    }


    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:albums,name,' . $album->id],
            'body' => ['required', 'string'],
        ]);
        $album->update($request->all());
        return redirect()->route('dashboard.myalbums');
    }


    public function destroyImages(Album $album)
    {
        if (Auth::user()->id == $album->user_id) {
            $album->images()->delete();
            return redirect()->route('dashboard.myalbums');
        }
    }
    public function asignAll(Request $request, Album $album)
    {
        foreach ($album->images as $image) {
            if (Auth::user()->id == $image->album->user_id) {

                $new_album = Album::find($request->album_id);
                $image->update([
                    'album_id' => $request->album_id,
                ]);
                Storage::copy("public/albums/" . $album->id . '/s_' . $image->picture, "public/albums/" . $new_album->id . '/s_' . $image->picture);
                Storage::delete('public/albums/' . $image->album_id . '/' . $image->picture);
                return redirect()->back();
            }
        }
    }
}
