@extends('layouts.app')

@section('title', 'ダッシュボード')

@section('content')

<div>
  <h1>管理者ダッシュボード</h1>
<form id="logout-form" action="{{ route('logout') }}" method="POST">
  @csrf
  <button type="submit" class="btn btn-danger">ログアウト</button>
</div>
@endsection