@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>文章</h2>

        @if(count($articles) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>標題</td>
                    <td>圖片</td>
                    <td>Soruce link</td>
                    <td>分類</td>
                    <td>網站</td>
                    <td>動作</td>
                </tr>
                @foreach ($articles as $art)
                    <tr>
                        <td>{{ $art->title }}</td>
                        <td><img src="{{ $art->image}}" width="150" alt=""></td>
                        <td>
                            <a href="{{ $art->source_link }}" target="_blank">
                                View
                            </a>
                        </td>
                        <td>{{ $art->category->title }}</td>
                        <td>{{ $art->website->title }}</td>
                        <td>
                            <form action="{{ route('articles.destory', ['id' => $art->id]) }}">
                                {{ method_filed('DELETE')}}
                                {{csrf_filed()}}
                                <button class="btn btn-danger" type="submit" onclick="if(!confirm('你確定嗎')) return false;">
                                    <i class="glyphicon glyphicon-remove"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (count($articles) > 0)
                <div class="pagination">
                    <?php echo $articles->render(); ?>
                </div>
            @endif

        @else
            <i>找不到分類</i>
        @endif
    </div>
</div>
@endsection