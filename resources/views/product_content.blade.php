@extends('master')

@include('component.loading')
@section('title', '产品详情')

@section('content')
<div class="weui_cells_title">图书详情</div>
    <div class="weui_cell_hd"><img src="{{$categorys->preview}}" alt=""></div>
    <div class="weui_cell_bd weui_cell_primary">
<p></p>
<p></p>
</div>
<div class="weui_cells_title">详情内容</div>
<div class="weui_cell_hd"><img src="{{$categorys->preview}}" alt=""></div>
<div class="weui_cell_bd weui_cell_primary">
    <p></p>
    <p></p>
</div>

<div class="bk_fix_bottom">
    <div class="bk_half_area">
        <button class="weui_btn weui_btn_primary" onclick="_addCart();">加入购物车</button>
    </div>
    <div class="bk_half_area">
        <button class="weui_btn weui_btn_default" onclick="_toCart()">查看购物车(<span id="cart_num" class="m3_price">{{$count}}</span>)</button>
    </div>
</div>

@endsection

@section('myjs')

<script type="text/javascript">

    function _addCart() {
        var product_id = "{{$categorys->id}}";
        $('.weui_loading_toast').show();
        //请求服务器，操作+1
        $.ajax({
            type:"get",
            url : '/addCart/product_id/' + product_id,
            dataType : 'json',
            success: function (data) {
                console.log(data);
                if(null == data){
                    $('.weui_loading_toast').hide();
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('服务器错误!');
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }
                if(data.code==200){
                    $('.weui_loading_toast').hide();
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('加入购物车成功');
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                }

            },
            error:function (status, error) {
                console.log(status);
                console.log(error);
            }
        })

        //处理加一
        var num = $('#cart_num').html();
        if(num == "") num = 0;
        $('#cart_num').html(Number(num)+1);
    }
    
    function _toCart() {
        window.location.href = "/cart";
    }

</script>

@endsection