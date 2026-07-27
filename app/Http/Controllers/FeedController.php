<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    //
    public function index(Request $request): JsonResponse
    {
        $posts = PostModel::with('user')->latest()
        ->pageinate($request->integer('per_page', 10));

        $feed = $posts->through(function (PostModel $post): array {
            return [
                'id' => $post->id,
                'content' => $post->content,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'author' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'username' => $post->user->username,
                    'profile_photo' => $post->user->profile_photo,
                    'cover_photo' => $post->user->cover_photo,
                ],
            ];
        });

        return response()->json([
            'message' => 'Feed retrieved successfully',
            'data' => $feed->items(),
            'meta' => [
                'current_page' => $feed->currentPage(),
                'last_page' => $feed->lastPage(),
                'per_page' => $feed->perPage(),
                'total' => $feed->total(),
            ]
        ]);
    }
}
