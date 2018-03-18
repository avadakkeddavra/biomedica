@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Просмотр категорий
@endsection

@section('contentheader_title')
    Просмотр faqs
@endsection

@section('custom_styles')
    <style>
        .card{
            background-color: #fff;
            box-shadow: 0 6px 10px 0 rgba(0,0,0,0.14), 0 1px 18px 0 rgba(0,0,0,0.12), 0 3px 5px -1px rgba(0,0,0,0.3);
        }
        .card .card-title{
            padding: 10px 20px;
            font-size: 16px;
            background-color: #e3e8e0;
        }
        .card-content{
            padding: 20px;
            color: #464646;
        }
        .card-actions{
            padding: 10px 20px;
            border-top: 1px solid #eee;
        }
        .card-actions button{
            background-color: transparent;
            border: none;
            outline: none;
            text-transform: uppercase;
            color: #5e5e5e;
            font-size: 12px;
        }
        .no-result {
            text-align: center;
            text-transform: uppercase;
            margin: 20px 0px;
            font-size: 16px;
            font-weight: bold;
            color: #6f6f6f;
        }
        .no-result i{
            display: inline-block;
            margin-bottom: 10px;
            color: #a2a2a2;
            font-size: 20px;
        }
    </style>
@endsection

@section('main-content')

    @php

    function text($faq){
        echo substr($faq->description,0,200);
    }

    @endphp

    <div class="container-fluid spark-screen">

        @if(!isset($faqs[0]))
            <h4 class="no-result"><i class="fa fa-info"></i><br>Нет статей</h4>
        @endif
        <div class="row">
            @foreach($faqs as $faq)
                <div class="col-md-3" style="transition: 0.3s;">
                    <div class="card">
                        <div class="card-title">
                            {{$faq->name}}
                        </div>
                        <div class="card-content">
                            {{ text($faq) }}
                        </div>
                        <div class="card-actions">
                            <button type="button" class="custom-btn">Редактировать</button>
                            <button type="button" data-id="{{$faq->id}}" class="delete custom-btn">Удалить</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection

@section('custom_scripts')

    <script>
        $(document).ready(function(){
            $('.delete').on('click',function(){
                var id = $(this).data('id');
                var $this = $(this).parents('.col-md-3');
                var accept = confirm("Вы уверенны что хотите удалить эту статью? Вместе с ней в удалите и анализ связанный с ней");
                if(accept == true)
                {
                    $.ajax({
                        url:'/admin/faqs/delete',
                        data:{id:id},
                        type:'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(response){
                            if(response.success = 1){
                                $this.css({
                                    opacity:0,
                                    transform:'scale(0)'
                                })
                                setTimeout(function(){
                                    $this.remove();
                                },300);
                            }
                        }
                    })
                }

            })
        })
    </script>

@endsection