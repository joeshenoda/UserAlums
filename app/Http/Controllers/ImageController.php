<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use App\Actions\Imag as ImagAction;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        $album = Album::find($request->album_id);
        if ($request->hasFile('picture1') && Auth::user()->id == $album->user_id) {
            $picture = (new ImagAction)->url($request->file('picture1'), $album->id, true);
            $validated = $request->validate([
                'album_id' => ['required', 'string', 'exists:albums,id'],
                'name' => ['required', 'string'],
            ]);
            $image = Image::create([
                'album_id' => $request->album_id,
                'user_id' => Auth::user()->id,
                'picture' => $picture,
                'name' => $request->name ?? '',
                'status' => '',
            ]);
        }
        return redirect()->back();
    }

    public function show(Album $album, Image $image)
    {
        return view('images.show')->with('image', $image);
    }

    public function destroy(Image $image)
    {
        if (Auth::user()->id == $image->album->user_id) {
            Storage::delete('public/albums/' . $image->album_id . '/' . $image->picture);
            Storage::delete('public/albums/' . $image->album_id . '/s_' . $image->picture);
            $image->delete();
        }

        return redirect('album/' . $image->album_id);
    }

    public function asign(Request $request, Image $image)
    {
        $validated = $request->validate([
            'album_id' => ['required', 'string', 'exists:albums,id'],
        ]);
        if (Auth::user()->id == $image->album->user_id) {
            $album = $image->album;
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
