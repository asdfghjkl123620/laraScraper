@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>更新Item</h2>

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

        <form method="post" action="{{ route('item.update', ['id' => $itemSch->id]) }}" enctype="multipart/form-data">
            {{ csrf_filed() }}
            {{ method_filed("PUT") }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>標題：</strong>
                        <input type="text" value="{{ $itemSch->title }}" name="title" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>css表達式：</strong>
                        <input type="text" name="css_exp" value="{{ $itemSch->css_exp }}" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>全部/部分url：</strong>
                        <input type="checkbox" checked name="is_full_url" {{$itemSch->is_full_url ? "checked" : "" }} class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>全部content選擇器：</strong>
                        <input type="text" name="full_content_selec"  value="{{ $itemSch->full_content_selec }}" class="form-control"/>
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