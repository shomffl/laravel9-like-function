<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post)
    {
        /**
         * liked_post_listsにAuthユーザーが「いいね」をした投稿を格納。ハートマークの色を変えるために使用。
         */
        return view("posts/index")->with(["posts" => $post->with("likedUsers")->get(), "liked_post_lists" => auth()->user()->likedPosts]);
    }

    public function create()
    {
        return view("posts/create");
    }

    public function store(Request $request, Post $post)
    {
        $input = $request->input("posts");
        $input += ["user_id" => auth()->id()];
        $post->fill($input)->save();
        return redirect(route("posts.index"));
    }

    // 中間テーブルに登録
    public function like(Request $request, Post $post)
    {
        $post->likedUsers()->attach(auth()->user());
        return redirect(route("posts.index"));
    }

    // 中間テーブルの該当データの登録解除
    public function unlike(Request $request, Post $post)
    {
        $post->likedUsers()->detach(auth()->user());
        return redirect(route("posts.index"));
    }
}
