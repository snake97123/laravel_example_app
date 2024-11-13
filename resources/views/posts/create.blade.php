<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('title', '新規投稿')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="space-y-6">
        <h1 class="text-2xl font-semibold mb-6">新規投稿</h1>
        <form action="{{ url('/post/create')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="images" class="block text-gray-700">画像</label>
                <input type="file" name="images[]" id="images" class="w-full p-2 border border-gray-300 rounded mt-1" multiple>
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">タイトル</label>
                <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700">本文</label>
                <textarea name="body" id="body" rows="5" class="w-full p-2 border border-gray-300 rounded mt-1" required></textarea>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                    投稿する
                </button>
                <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ">
                  戻る
                </a>
            </div>
        </form>
    </div>
</div>
@endsection     