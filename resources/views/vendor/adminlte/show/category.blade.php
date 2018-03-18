@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Просмотр категорий
@endsection

@section('contentheader_title')
    Просмотр категорий
@endsection

@section('custom_styles')
    <style>
        .dropdown-card{
            display: block;
            line-height: 44px;
            padding: 0px 10px;
            background: #eee;
            box-shadow: 0px 0px 10px 0px #7a7879;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }
        .dropdown-card .label-default{
            background-color: #44ca74;
        }
        .dropdown-content .dropdown-card .label-default{
            background-color: #a5a5a5;
        }
        .dropdown-card .title{
            color: #888888;
        }

        .dropdown-card  input{
            color: #888888;
            border:none;
            outline: none;
            box-shadow: none;
            line-height: normal;
            padding: 7px 5px;
            background-color: transparent;
            border-bottom: 1px solid #787878;
        }

        .dropdown-content{
            display: block;
        }
        .dropdown-content ul{
            list-style:none;
            padding: 0;
        }

        .dropdown-content .dropdown-card{
            box-shadow: none;
            margin: 0px -10px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding-left: 15px;
        }

        .dropdown-card .actions{
             float: right;
         }
        .dropdown-card .actions button{
            background-color: transparent;
            color: #979797;
            outline: none;
            font-size: 12px;
            border:none;
        }
        
    </style>
@endsection
@section('main-content')


    <div class="container-fluid spark-screen">
        <div class="row">

                @foreach($categories as $category)
                <div class="col-md-3">
                    <div class="dropdown-card" data-id="{{$category->id}}">

                        <span class="title">{{$category->name}}</span>
                        <span class="label label-default"><b>p</b></span>
                        <input type="text" class="hidden changeName" data-old="{{$category->name}}" value="{{$category->name}}">
                        <div class="actions">
                            <button class="edit"><i class="fa fa-pencil"></i></button>
                            <button class="delete" data-id="{{$category->id}}"><i class="fa fa-trash-o"></i></button>
                            <button class="toggle"><i class="fa fa-angle-down"></i></button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="dropdown-content">

                            @foreach($category->children as $sub_cat)
                                <div class="dropdown-card" data-id="{{$sub_cat->id}}">
                                    <span class="title">{{$sub_cat->name}}</span>
                                    <span class="label label-default">c</span>
                                    <input type="text" class="hidden changeName" data-old="{{$sub_cat->name}}" value="{{$sub_cat->name}}">
                                    <div class="actions">
                                        <button class="edit"><i class="fa fa-pencil"></i></button>
                                        <button class="delete" data-id="{{$sub_cat->id}}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach


        </div>
    </div>

@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {


            $('.toggle').on('click',function(){
                $(this).parents('.dropdown-card').find('.dropdown-content').slideToggle(100);
            });

            $('.edit').on('click',function(){
                $(this).parent().parent().find('.title').eq(0).hide();
                $(this).parent().parent().find('input').eq(0).removeClass('hidden');
                $(this).parent().parent().find('input').eq(0).addClass('visible');

                $input = $(this).parent().parent().find('input').eq(0);
                $title = $(this).parent().parent().find('.title').eq(0);

                $(document).mouseup(function (e){ // событие клика по веб-документу
                    var div = $input; // тут указываем ID элемента
                    if (!div.is(e.target) // если клик был не по нашему блоку
                        && div.has(e.target).length === 0) { // и не по его дочерним элементам
                        div.addClass('hidden');
                        div.val(div.attr('data-old'));
                        div.removeClass('visible');
                        $title.show();
                    }
                });
            });

            $('.changeName').on('keydown',function(e){
                if(e.keyCode == 13)
                {
                   var $this = $(this);
                   var title = $(this).parent().children('.title');
                   var val = $(this).val();
                   var oldval = $(this).attr('data-old');
                   var id = $(this).parent().data('id');
                   if(val != oldval)
                   {
                        $.ajax({
                            url:'/admin/category/change',
                            data:{name:val, id:id},
                            type:'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success:function(response){
                                console.log(response)
                                if(response.success == 1)
                                {

                                    $this.attr('data-old',response.response.name);
                                    title.text(response.response.name);
                                    $(document).trigger('mouseup');
                                }
                            }
                        })

                   }
                }
            })

            $('.delete').on('click',function(){
                var id = $(this).data('id');
                var item = $(this).parent().parent();
                var check = confirm("Вы уверены что хотите удалить эту категорию?");
                console.log(check);
                if(check == true)
                {
                    $.ajax({
                        url:'/admin/category/delete',
                        data:{id:id},
                        type:'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(response){
                            item.remove();
                        }
                    })
                }

            })
        })

    </script>

@endsection