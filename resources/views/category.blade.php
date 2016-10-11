@extends('master')

@section('component.loading')


@section('title', '分类')


@section('content')

    <div class="weui_cells_title">选择分类</div>
    <div class="weui_cells">
        <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="select1">
                    @foreach($categorys as $category)
                    <option selected="" value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_access">


    </div>
    </div>


@endsection


@section('myjs')
<script type="text/javascript">

    ajaxGet();
    $('.weui_select').change(function (event){
        ajaxGet();
    })
    
    function ajaxGet() {
        var parent_id = $('.weui_select option:selected').val();
        $.ajax({
            type:"get",
            url : '/Service/category/parent_id/'+parent_id,
            dataType : 'json',
            success: function (data) {
                if(null == data){
                    $('.weui_loading_toast').hide();
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('服务器错误!');
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data){
                   $('.weui_cells_access').html('');
                   for(var i=0;i<data.data.length;i++){
                       var url = 'prductlist/parent_id/' + data.data[i].id;
                       var str = '<a class="weui_cell" href="'+ url +'">'+
                           '<div class="weui_cell_bd weui_cell_primary">'+
                           '<p>'+ data.data[i].name +'</p>'+
                           '</div>'+
                           '<div class="weui_cell_ft">'+
                       '</div>'+
                       '</a>'
                       $('.weui_cells_access').append(str);
                   }
                }else{
                    $('.weui_loading_toast').hide();
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html(data.message);
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
            },
            error:function (status, error) {
                console.log(status);
                console.log(error);
            }
        })
    }

</script>

@endsection