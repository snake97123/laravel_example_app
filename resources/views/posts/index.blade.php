 <!-- $postの中身をみて、タイトルとボディーを表示する。 -->
 @extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
@if (session('success'))
<div id="alert-border-2" class="flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div class="ms-3 text-sm font-medium">
      {{ session('success')}}
    </div>
    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-2" aria-label="Close">
      <span class="sr-only">Dismiss</span>
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
    </button>
</div>
@endif
<div class="max-w-xl mx-auto p-6">
    <div class="space-y-6">
      <div class="flex justify-end mb-4">
        <a href="{{ url('post/create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
          新規投稿
        </a>
      </div>
        @foreach ($posts as $post)
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
              <!-- show post detail -->
              <a href="{{ url('posts/show/' . $post->id) }}">
                @if ($post->postImages && $post->postImages->isNotEmpty())
                  <div class="swiper-container relative pb-8">
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
                @else
                    <img src="https://picsum.photos/600/400?random={{ $loop->index }}" alt="Post image" class="w-full h-64 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700">{{ $post->body }}</p>
                    <p class="text-gray-700">
                      by: <i>{{ $post->user->name}}</i>
                    </p>
                </div>
              </a>
              <div class="flex justify-end p-4">
                <form action="{{ url('post/delete/' . $post->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @if (Auth::id() === $post->user_id)
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        削除
                    </button>
                    @endif
                </form>
              </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection