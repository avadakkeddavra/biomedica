@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Создание статей
@endsection
@section('contentheader_title')
    Создание статей
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
        label{
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
        }
    </style>
@endsection
@section('main-content')

        <div class="container-fluid spark-screen hide response">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-primary">
                        <div class="box-body">
                            <div class="callout callout-success">
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Создать</div>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Название</label>
                                <input type="text" name="name" id="name" placeholder="Название" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Описание</label>
                                <textarea name="desc" id="editor1"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Информация для доктора</label>
                                <textarea name="desc" id="editor2"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}"></script>
    <script>
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
        $('button').click(function(){
            var data = {
                name: $('#name').val(),
                desc:$('#editor1').val(),
                doct:$('#editor2').val()
            };
            $.ajax({
                url:"/admin/faqs/create",
                data:data,
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    console.log(response);
                   if(response.success == 1){
                       $('.response').removeClass('hide');
                       $('.response').find('.callout').removeClass('callout-danger');
                       $('.response').find('.callout').addClass('callout-success');
                       $('.response').find('.callout').append('<p>Статья была создана</p>');
                   }
                },
                error:function(xhr){
                   var errors = xhr.responseJSON.errors;
                    $('.response').find('.callout').children('h4').text('Ошибка');
                   for(i in errors)
                   {
                       $('.response').find('.callout').append('<p>'+errors[i]+'</p>');
                   }

                    $('.response').removeClass('hide');
                    $('.response').find('.callout').removeClass('callout-success');
                    $('.response').find('.callout').addClass('callout-danger');
                }
            })
        });
    </script>
@endsection