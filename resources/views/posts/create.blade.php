<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="m-10 p-10">
        <form action={{route("posts.store")}} method="POST" class="flex flex-col gap-4">
            @csrf
            <input class="p-2 rounded w-1/2 text-4xl shadow-lg border border-black" name="posts[title]"/>
            <textarea class="w-3/4 border border-black rounded" name="posts[body]"></textarea>
            <button class="px-4 py-1  bg-indigo-500  border-b-4 border-indigo-800 active:scale-95 active:border-opacity-10 rounded text-white w-max" type="submit">send</button>
        </form>
    </div>
</x-app-layout>
