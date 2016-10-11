@extends('master')

@include('component.loading')


@section('title','登入')

@section('content')
    <div class="weui_cells_title"></div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">帐号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" placeholder="邮箱或手机号" name="email"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" placeholder="不少于6位" name="passwd_email"/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="请输入验证码" name="validate_code"/>
            </div>
            <div class="weui_cell_ft">
                <img src="/create" class="bk_validate_code"/>
            </div>
        </div>
    </div>
    <div class="weui_cells_tips"></div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onLoginClick();">登录</a>
    </div>
    <a href="/register" class="bk_bottom_tips bk_important">没有帐号? 去注册</a>
@endsection

@section('myjs')
    <script type="text/javascript">
        $('.bk_validate_code').click(function () {
            $(this).attr('src', '/create?random=' + Math.random());

        });

        function onLoginClick() {
            var email    = $('input[name=email]').val();
            var password = $('input[name=passwd_email]').val();
            var validate_code = $('input[name=validate_code]').val();
            if(email=="" || password=="" || validate_code==""){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('请填写完整!');
                setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                return false;
            }

            $.ajax({
                type: 'post',
                url : '/logins',
                dataType: 'json',
                data:{email:email,password:password,validate_code:validate_code,_token:"{{csrf_token()}}"},
                success: function (data) {
                    if(null == data){
                        $('.weui_loading_toast').hide();
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html('服务器错误!');
                        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    }
                    if(data.code == 200){
                        $('.weui_loading_toast').hide();
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html('登入成功!');
                        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                        window.location.href = data.redirect_url;
                    }else{
                        $('.weui_loading_toast').hide();
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html(data.message);
                        setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    }

                },
                error: function (status, error) {
                    
                }
                
            })

        }




    </script>
@endsection
