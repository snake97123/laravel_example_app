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
          @if ($post->postImages && $post->postImages->isNotEmpty())
            <div class="relative pb-8"> <!-- Swiperコンテナ -->
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  @foreach ($post->postImages as $image)
                    <div class="swiper-slide">
                      <img src="{{ Storage::url($image->url) }}" alt="Post image" class="w-full h-64 object-cover">
                    </div>
                  @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination absolute bottom-0 left-0 w-full text-center"></div>
              </div>
            </div>
          @else
            <img src="https://picsum.photos/600/400?random={{ rand() }}" alt="Post image" class="w-full h-64 object-cover">
          @endif
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-700">{{ $post->body }}</p>
                <p class="text-gray-700">
                      by: <i>{{ $post->user->name}}</i>
                    </p>
            </div>
          <div class="flex justify-end space-x-4 p-4">
            <a href="{{ url('posts') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
              戻る
            </a>
            @if (Auth::id() === $post->user_id)
            <a href="{{ url('post/edit/' . $post->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
              編集
            </a>
            @endif
          </div>
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection