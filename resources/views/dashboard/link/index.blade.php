@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h2>連結</h2>
        <div class="alert alert-succedd" style="display: none"></div>
        <a href="{{ route('links.create') }}" class="btn btn-success">加入新的</a>

        @if(count($links) > 0)
            <table class="table table-bordered">
                <tr>
                    <td>Url</td>
                    <td>Main Filter Selector</td>
                    <td>Website</td>
                    <td>Assigned to 分類</td>
                    <td>Item</td>
                    <td>爬取連結</td>

                    <td>動作</td>
                </tr>
                @foreach ($links as $link)
                    <tr data-id="{{ $link->id }}">
                        <td>{{ $link->url }}</td>
                        <td>{{ $link->main_filter_selec }}</td>
                        <td>{{ $link->website->title }}</td>
                        <td><strong><span class="label label-info">{{ $link->category->title }}</strong></span></td>

                        <td>
                            <select class="item" data-id="{{ $link->id }}" data-original-schema="{{$link->item_id}}">
                                <option value="" disabled selected>Select</option>
                                @foreach ($itemSch as $item)
                                    <option value="{{$item->id}}" {{ $item->id==$link->item_id?"selected":""}}>{{$item->title}}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-info btn-sm btn-apply" style="display: none">套用</button>
                        </td>

                        <td>
                            @if ($link->item_id != "" && $link->main_filter_selec != "")
                                <button type="button" class="btn btn-info btn-sm btn-scrape" style="display: none">爬取<i class="glyphicon glyphicon-repeat fast-right-spinner" style="display: none"></i>
                                </button>
                            @else
                                <span style="color:red">請先填入filter select 和item欄位</span>
                            @endif
                        </td>
        
                        <td>
                            <a href="{{ url('dashboard/links/' . $link->id . '/edit')}}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            @if (count($links) > 0)
                <div class="pagination">
                    <?php echo $links->render(); ?>
                </div>
            @endif

        @else
            <i>找不到links</i>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $("select.item").change(function() {
            if ($(this).val() != $(this).attr("data-original-schema")) {
                $(this).siblings('.btn-apply').show();
            }
        });

        $('.btn-apply').click(function () {

            let btn = $(this);

            let tRowId = $(this).parents("tr").attr("data-id");

            let sch_id = $(this).siblings('select').val();

            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "{{ url('dashboard/links/set-item-schema')}}",
                data: {link_id: tRowId, item_id: sch_id, _token: "{{ csrf_token() }}", _method: "patch"},
                method:"post",
                dataType:"json",
                success: function(res) {
                    alert(res.msg);

                    btn.hide();
                }
            });
        });

        $(".btn-scrape").click(function () {
            let btn = $(this);

            btn.find(".fast-right-spinner").show();

            btn.prop("disabled", true);

            let tRowId = $(this).parents("tr").attr("data-id");

            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "{{ url('dashboard/links/scrape')}}",
                data: {link_id: tRowId, _token: "{{ csrf_token() }}"},
                method:"post",
                dataType:"json",
                success: function(res) {
                    if (res.status == 1) {
                        $(".alert").removeClass("alert-danger").addClass("alert-success").text(res.msg).show();
                    } else {
                        $(".alert").removeClass("alert-success").addClass("alert-danger").text(res.msg).show();

                    }

                    btn.find(".fast-right-spinner").hide();
                }
            });
        });
    });
</script>
    
@endsection