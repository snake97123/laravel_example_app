@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="space-y-6">
      <div class="flex justify-end mb-4">
        <a href="{{ url('post/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
          新規投稿
        </a>
      </div>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <!-- show post detail -->
          <a href="{{ url('post/' . $post->id) }}">
            <img src="https://picsum.photos/600/400?random=1" alt="Post image" class="w-full h-64 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-700">{{ $post->body }}</p>
            </div>
          </a>
          <div class="flex justify-justify-end space-x-4 p-4">
            <a href="{{ url('posts') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
              戻る
            </a>
            <a href="{{ url('post/edit/' . $post->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
              編集
            </a>
          </div>
        </div>
    </div>
</div>
@endsection