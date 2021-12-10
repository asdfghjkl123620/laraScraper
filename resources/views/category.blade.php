@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>分類：{{$category->title}}</h2>

            @if (count($articles) > 0)
                @foreach ($articles as $art)
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($art->image))
                                <img src="{{ $art->image }}" class="m-3 img-responsive img-thumbnail" width="200"/>
                            @endif

                            <h4><a href="{{ url('article-details/' . $art->id) }}">{{ $art->title }}</a></h4>
                            <span class="label label-info">{{$art->category->title}}</span>

                            @if (!empty($art->excerpt))
                                <article>
                                    <p>{{ $art->excerpt }}</p>
                                </article>
                            @endif

                            <em>資源來源： <a href="{{ $art->source_link }}" class="label label-danger" target="_blank">{{ $art->website->title}}</a></em>
                            <a href="{{ url('article-details/' . $art->id) }}" class="btn btn-waring">閱讀更多</a>
                        </div>
                    </div>
                    <hr/>
                @endforeach
                    @if (count($articles)>0)
                        <div class="pagination">
                            <?php echo $articles->render(); ?>
                        </div>
                    @endif
            @else
                    <i>沒有找到文章</i>
    
            @endif

        </div>
    </div>
    
@endsection