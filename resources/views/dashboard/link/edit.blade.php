@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>更新Link {{$link->id}}</h2>

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

        <form method="post" action="{{ route('links.update', ['id' => $link->id]) }}" enctype="multipart/form-data">
            {{ csrf_filed() }}
            {{ method_filed("PUT") }}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Url：</strong>
                        <input type="text" value="{{ $link->url }}" name="url" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>Filter Selector：</strong>
                        <input type="text" value="{{ $link->main_filter_selec }}" name="main_filter_selec" class="form-control"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>網站：</strong>
                        <select class="form-control" name="website_id">
                            <option value="">Select</option>
                            @foreach ($websites as $website)
                                <option {{ $website->id==$link->website_id?"selected":"" }} value="{{$website->id}}">{{$website->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <strong>類別：</strong>
                        <select class="form-control" name="category_id">
                            <option value="">Select</option>
                            @foreach ($categories as $category)
                                <option {{ $category->id==$link->category_id?"selected":"" }} value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
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