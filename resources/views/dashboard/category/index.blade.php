@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>分類</h2>
        <a href="{{ route('categories.create') }}" class="btn btn-success">加入新的</a>

        @if(count($categories) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>標題</td>
                    <td>動作</td>
                </tr>
                @foreach ($categories as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>
                            <a href="{{ url('dashboard/categories/' . $item->id . '/edit')}}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (count($categories) > 0)
                <div class="pagination">
                    <?php echo $categories->render(); ?>
                </div>
            @endif

        @else
            <i>找不到分類</i>
        @endif
    </div>
</div>
@endsection