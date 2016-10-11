@extends('master')


@section('title', '产品列表')



@section('content')
    <div class="weui_cells_title">图书列表项</div>
    <div class="weui_cells weui_cells_access">
      @foreach($categorys as $category)
        <a class="weui_cell" href="/productContent/id/{{$category->id}}">
            <div class="weui_cell_hd"><img src="{{$category->preview}}" alt="" style="width:120px;margin-right:5px;display:block"></div>
            <div class="weui_cell_bd weui_cell_primary">
                <p>{{$category->name}}</p>
                <p>{{$category->summary}}</p>
            </div>
            <div class="weui_cell_ft">价格: ￥{{$category->price}}</div>
        </a>
      @endforeach
    </div>
@endsection

@section('myjs')



@endsection