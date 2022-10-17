<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-10">
        <a type="button" href={{route("posts.create")}} class="px-3 py-1 mb-6 bg-red-500 text-white border-b-4 border-red-700 active:scale-95 active:border-opacity-10">
            Create
        </a>

        <div>
            @foreach ($posts as $post)
                <div class="flex justify-between items-center p-5 mx-10 my-5 rounded shadow-lg bg-white">
                    <div>
                        <div class="text-2xl">title : {{$post->title}}</div>
                        <div>body : {{$post->body}}</div>
                    </div>

                    {{-- ログインユーザーがいいねしている投稿と一致していれば、赤色のハートマークを表示 --}}
                    @if ($liked_post_lists->contains($post->id))
                        <div class="flex">
                            <form action={{route("unlike", $post->id)}} method="POST" class="border-red-500">
                                @csrf
                                <button type="submit"><img class="w-1/2" src="{{ asset('/image/red-heart.png') }}"></button>
                            </form>
                            {{-- 投稿に紐付いているユーザーの数（投稿をいいねしたユーザーの数）を表示 --}}
                            <span>{{$post->likedUsers->count()}}</span>
                        </div>
                    @else
                        <div class="flex">
                            <form action={{route("like", $post->id)}} method="POST" class="border-red-500">
                                @csrf
                                <button type="submit"><img class="w-1/2" src="{{ asset('/image/gray-heart.png') }}"></button>
                            </form>
                            <span>{{$post->likedUsers->count()}}</span>
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
