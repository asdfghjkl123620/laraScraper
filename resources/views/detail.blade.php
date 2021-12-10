@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>分類：{{$article->title}}</h2>
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ $article->image }}" class="m-5 img-responsive img-thumbnail" alt="">
                    <span class="label label-info"><a href="{{ url('category/'.$article->category_id) }}">{{$article->category->title}}</a></span>
                    <em>資源來源：</em><a href="{{ $article->source_link }}" class="label label-danger" target="_blank">{{ $article->website->title}}</a>
                    <article>
                        <p>{!! $article->content !!}</p>
                    </article>
                </div>
            </div>

        </div>
    </div>
    
@endsection