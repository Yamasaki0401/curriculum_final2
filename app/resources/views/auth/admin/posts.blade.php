@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>投稿詳細</h2>
    <p><strong>ID:</strong> {{ $post->id }}</p>
    <p><strong>タイトル:</strong> {{ $post->title }}</p>
    <p>料金：{{ $post->amount_label }}</p>
    <p><strong>内容:</strong> {{ $post->introduction }}</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection
