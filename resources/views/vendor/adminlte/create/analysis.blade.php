@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Анализы
@endsection

@section('contentheader_title')
    Создание анализов
@endsection
@section('custom_styles')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">
    <style>
        iframe{
            display: block !important;
            border:1px solid #bfbfbf !important;
            border-radius: 3px !important;
            width: 100% !important;

        }
    </style>
@endsection
@section('main-content')

        <div class="container-fluid spark-screen response" style="display: none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-primary">
                        <div class="box-body">
                            <div class="callout callout-success">
                                <h4>Успех</h4>
                                <p>Анализ был успешно создан</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid spark-screen response_error" style="display: none;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-danger">
                        <div class="box-body">
                            <div class="callout callout-danger">
                                <h4>Ошибка</h4>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Создать</div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Название</label>
                                <input type="text" name="name" id="name" placeholder="Название" class="form-control ">
                            </div>
                            <div class="form-group">
                                <label for="">Категория</label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Статус</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Активный</option>
                                    <option value="0">Не активный</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">FAQ</label>
                                <select name="article_id" id="article_id" class="form-control">
                                    @foreach($articles as $article)
                                        <option value="{{$article->id}}">{{$article->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Цены</label>
                                <div class="form-group prices">
                                    @foreach($cities as $city)
                                        <div style="margin-bottom: 7px;">
                                            <label for="" class="label label-primary" style="width: 80px;display: inline-block; padding: 5px 0px;">{{$city->name}}</label>
                                            <input type="number" name="{{$city->id}}" class="form-control price" style="display: inline-block;width: auto;" placeholder="Цена">
                                            <b>UAH</b>
                                        </div>

                                    @endforeach
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="button" id="create" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                        <p class="errors bg-red"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-title">Описание анализа</div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <textarea id="editor1"></textarea>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-title">Приватное описание</div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <textarea id="editor2"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_scripts')

    <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>

    <script>
    $(document).ready(function(){
        $('#editor1,#editor2').wysihtml5({
            "stylesheets": ["{{asset('plugins/bootstrap-wysihtml5/editor.css')}}"],
            "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
            "emphasis": true, //Italics, bold, etc. Default true
            "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
            "html": false, //Button which allows you to edit the generated HTML. Default false
            "link": true, //Button to insert a link. Default true
            "image": true, //Button to insert an image. Default true,
            "color": false, //Button to change color of font
            "blockquote": true
    });
                $('#create').click(function() {
                    var prices = [];

                    $('.prices').find('.price').each(function (i, elem) {
                        var val = $(this).val();
                        var key = $(this).attr('name');
                        prices.push({
                            key: key,
                            value: val
                        });
                        console.log(prices);
                    });


                    var data = {
                        name: $('#name').val(),
                        cat_id: $('#cat_id').val(),
                        article_id: $('#article_id').val(),
                        status: $('#status').val(),
                        prices: prices,
                        description:$('#editor1').val(),
                        doct:$('#editor2').val()
                    };

                    $.ajax({
                        url: "/admin/analysis/create",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        success: function (response) {
                            if (response.success == 1) {

                                $('p.errors').text('');
                                $('.alert-error').removeClass('alert-error')
                                $('.response').slideDown(200);
                            }

                        },
                        error: function (xhr) {
                            console.log(xhr.responseJSON.errors);
                            for (i in xhr.responseJSON.errors) {
                                var item = xhr.responseJSON.errors[i];
                                console.log(item);
                                $('#' + i).addClass('alert-error');
                                $('p.errors').text(item);
                            }
                        }
                    })
                })
        });
    </script>
@endsection