@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>更新類別</h2>

        @if (session('error')!='')
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        <form method="post" action="{{ route('categories.update', ['id' => $category->id]) }}" enctype="multipart/form-data">
            {{ csrf_filed() }}
            {{ method_filed("PUT") }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>標題：</strong>
                        <input type="text" value="{{ $category->title }}" name="title" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary" id="button-save">更新</button>
            </div>
        </form>
    </div>
</div>


@endsection