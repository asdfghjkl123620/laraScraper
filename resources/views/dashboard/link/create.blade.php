@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>加新Link</h2>

            @if (session('error')!='')
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('links.store') }}" enctype="multipart/form-data">
                {{ csrf_filed() }}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Url：</strong>
                            <input type="text" name="url" class="form-control"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Filter Selector：</strong>
                            <input type="text" name="main_filter_selec" class="form-control"/>
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
                                    <option value="{{$website->id}}">{{$website->title}}</option>
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
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" id="button-save">建立</button>
                </div>
            </form>
        </div>
    </div>
    
@endsection