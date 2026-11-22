<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Media;
use App\Http\Resources\MediaResource;

class CollectionController extends Controller
{
    // Menampilkan koleksi pengguna
    public function index(string $userId)
    {
        $user = User::with('media.users')->find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Koleksi pengguna berhasil ditampilkan',
            'data' => MediaResource::collection($user->media)
        ], 200);
    }

    // Menambahkan media ke koleksi
    public function attach(string $userId, string $mediaId)
    {
        $user = User::find($userId);
        $media = Media::find($mediaId);

        if (!$user || !$media) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna atau media tidak ditemukan'
            ], 404);
        }

        if ($user->media()->where('media_id', $mediaId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Media sudah ada di koleksi pengguna'
            ], 409);
        }

        $user->media()->attach($mediaId);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil ditambahkan ke koleksi'
        ], 201);
    }

    // Menghapus media dari koleksi
    public function detach(string $userId, string $mediaId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        if (!$user->media()->where('media_id', $mediaId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Media tidak ditemukan dalam koleksi'
            ], 404);
        }

        $user->media()->detach($mediaId);

        return response()->json([
            'success' => true,
            'message' => 'Media berhasil dihapus dari koleksi'
        ], 200);
    }
}
