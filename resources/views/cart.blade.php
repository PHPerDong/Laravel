@extends('master')

@section('component.loading')


@section('title', '分类')


@section('content')

    <div class="page bk_content" style="top: 0;">
        <div class="weui_cells weui_cells_checkbox">
            @foreach($cart_items as $cart_item)
                <label class="weui_cell weui_check_label" for="{{$cart_item->id}}">
                    <div class="weui_cell_hd" style="width: 23px;">
                        <input type="checkbox" class="weui_check" name="cart_item" id="{{$cart_item->id}}" checked="checked">
                        <i class="weui_icon_checked"></i>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="position: relative;">
                            <img class="bk_preview" src="{{$cart_item->preview}}" class="m3_preview" onclick="_toProduct({{$cart_item->id}});"/>
                            <div style="position: absolute; left: 100px; right: 0; top: 0">
                                <p>{{$cart_item->name}}</p>
                                <p class="bk_time" style="margin-top: 15px;">数量: <span class="bk_summary">x{{$cart_item->num}}</span></p>
                                <p class="bk_time">总计: <span class="bk_price">￥{{$cart_item->price*$cart_item->num}}</span></p>
                            </div>
                        </div>
                    </div>
                </label>
            @endforeach
        </div>
    </div>
    {{-- <form action="/order_commit" id="order_commit" method="post">
      {{ csrf_field() }}
      <input type="hide" name="product_ids" value="" />
      <input type="hide" name="is_wx" value="" />
    </form> --}}
    <div class="bk_fix_bottom">
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_primary" onclick="_toCharge();">结算</button>
        </div>
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_default" onclick="_onDelete();">删除</button>
        </div>
    </div>



@endsection


@section('myjs')
<script type="text/javascript">

    $('input:checkbox[name=cart_item]').click(function () {
        var  checked = $(this).attr('checked');
        if(checked == 'checked'){
            $(this).attr('checked',false);
            $(this).next().removeClass('weui_icon_checked');
            $(this).next().addClass('weui_icon_unchecked');
        }else{
            $(this).attr('checked',true);
            $(this).next().removeClass('weui_icon_unchecked');
            $(this).next().addClass('weui_icon_checked');
        }
    })

    function _toProduct(id) {

    }

    function _onDelete() {
        var productId = [];
        $('input:checkbox[name=cart_item]').each(function () {
            if($(this).attr('checked') == 'checked'){
                productId.push($(this).attr('id'))//压入ID
            }
        })
        if(productId && productId.length == 0){
            $('.bk_toptips').show();
            $('.bk_toptips span').html('请选择要删除的产品');
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
        }
        //删除操作

    }


</script>

@endsection