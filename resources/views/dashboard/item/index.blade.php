@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>Item表</h2>
        <a href="{{ route('item.create') }}" class="btn btn-success">加入新的</a>

        @if(count($websites) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>標題</td>
                    <td>css表達式</td>
                    <td>full url for Article</td>
                    <td>動作</td>
                </tr>
                @foreach ($itemSch as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td><{{ $item->css_exp }}</td>
                        <td><{{ $item->is_full_url }}</td>
                        <td><{{ $item->full_content_selec }}</td>
                        <td>
                            <a href="{{ url('dashboard/item/' . $item->id . '/edit')}}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (count($itemSch) > 0)
                <div class="pagination">
                    <?php echo $itemSch->render(); ?>
                </div>
            @endif

        @else
            <i>找不到Items</i>
        @endif
    </div>
</div>
@endsection