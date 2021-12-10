@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>網站</h2>
        <a href="{{ route('websites.create') }}" class="btn btn-success">加入新的</a>

        @if(count($websites) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>標題</td>
                    <td>Logo</td>
                    <td>url</td>
                    <td>動作</td>
                </tr>
                @foreach ($websites as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td><img width="150" src="{{ url('uploads/' . $item->logo)}}"/></td>
                        <td>
                            <a href="{{ $item->url }}">
                                {{ $item->url }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('dashboard/websites/' . $item->id . '/edit')}}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (count($websites) > 0)
                <div class="pagination">
                    <?php echo $websites->render(); ?>
                </div>
            @endif

        @else
            <i>找不到網站</i>
        @endif
    </div>
</div>
@endsection