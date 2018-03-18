@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Просмотр анализов
@endsection

@section('contentheader_title')
    Просмотр анализов
@endsection
@section('main-content')


    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="box-title">Просмотр анализов</div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead>
                                    <th>Назавние</th>
                                    <th>Категория</th>
                                    <th>Статус</th>
                                    <th>FAQ</th>
                                    <th>Цены</th>
                                <tbody>
                                @foreach($analysis as $analis)
                                    <tr>
                                        <td>{{$analis->name}}</td>
                                        <td>{{$analis->category->name}}</td>
                                        <td>
                                            @if($analis->status == 1)
                                                <span class="label label-success">active</span>
                                            @else
                                                <span class="label label-danger">disabled</span>
                                            @endif
                                        </td>
                                        <td>{{$analis->article->name}}</td>
                                        <td>
                                                @foreach($analis->prices as $price)
                                                    <p><span class="label label-default">{{$price->city->name}}</span> <b>{{$price->value}} UAH</b>  </p>
                                                @endforeach
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('custom_scripts')

@endsection