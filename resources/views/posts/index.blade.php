 <!-- $postの中身をみて、タイトルとボディーを表示する。 -->
 @extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
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
                    @foreach ($post->postImages as $image)
                    <img src="{{ Storage::url($image->url) }}" alt="Post image" class="w-full h-64 object-cover">
                    @endforeach
                @else
                    <img src="https://picsum.photos/600/400?random={{ $loop->index }}" alt="Post image" class="w-full h-64 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-700">{{ $post->body }}</p>
                </div>
              </a>
              <div class="flex justify-end p-4">
                <form action="{{ url('post/delete/' . $post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        削除
                    </button>
                </form>
              </div>
            </div>
        @endforeach
    </div>
</div>
@endsection