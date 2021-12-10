@extends('layout.app')


@section('title', $post['title'])

@section('content')
@if($post['is_new'])
<div> A new blog post use if</div>
@elseif(!$post['is_new'])
<div>usein else if</div>
@endif

@unless($post['is_new'])
<div>it is an old</div>
@endunless

@isset($post['is_comments'])
<div>the post has some comments using isset</div>
@endisset

<h3>{{ $post['title'] }}</h3>
<p>{{ $post['content']}}</p>
@endsection