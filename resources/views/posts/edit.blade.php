<!-- resources/views/posts/edit.blade.php -->

@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="space-y-6">
        <h1 class="text-2xl font-semibold mb-6">投稿の編集</h1>
        <form action="{{ url('/post/update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $post->id }}">
            <div class="mb-4">
                <label for="title" class="block text-gray-700">タイトル</label>
                <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ $post->title }}" required>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700">本文</label>
                <textarea name="body" id="body" rows="5" class="w-full p-2 border border-gray-300 rounded mt-1" required>{{ $post->body }}</textarea>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                    更新する
                </button>
                <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                  戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection