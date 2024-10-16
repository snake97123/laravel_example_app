@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')
<!-- 作成したコンポーネントファイルを呼び出す。 -->
<x-alert type="warning">
  <!-- component/alert.blade.phpのslotの中に入る -->
  これは警告メッセージです。
</x-alert>
<h1 class="text-center">index2のタイトルです。</h1>
@foreach ($posts as $post)
<div>
  <h2>タイトル名：{{ $post->title }}</h2>
  <p>本文：{{ $post->body }}</p>
</div>
@endforeach
@endsection
