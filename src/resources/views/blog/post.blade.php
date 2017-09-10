@extends('blog.base')

@push('title') {{ $post->title->value  }} | Blog @endpush

@section('main')

@include('modules.blog.post-l')

@endsection