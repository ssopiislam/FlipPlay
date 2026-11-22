<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;

class MediaController extends Controller
{
    // Menampilkan semua media
    public function index()
    {
        $media = Media::with('users')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar media FlipPlay berhasil ditampilkan',
            'data' => MediaResource::collection($media)
        ], 200);
    }

    // Menampilkan detail media
    public function show(string $id)
    {
        $media = Media::with('users')->find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail media berhasil ditampilkan',
            'data' => new MediaResource($media)
        ], 200);
    }

    // Menambahkan media
    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());
        $media->load('users');

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil ditambahkan',
            'data' => new MediaResource($media)
        ], 201);
    }

    // Mengubah media
    public function update(UpdateMediaRequest $request, string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        $media->update($request->validated());
        $media->load('users');

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil diperbarui',
            'data' => new MediaResource($media)
        ], 200);
    }

    // Menghapus media
    public function destroy(string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan'
            ], 404);
        }

        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}
