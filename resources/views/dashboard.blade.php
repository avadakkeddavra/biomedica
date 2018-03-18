@extends('layouts.app')

@section('content')

<div class="row">

        @foreach($analysis as $item)
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="img/photo3.jpg" alt="">
                        <div class="card-title">{{$item->name}}</div>
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <p>@php echo $item->description @endphp</p>

                        </div>
                        <div class="card-action">
                            <a href="/pay/create/{{$item->id}}" target="_blank">pay</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


</div>


@endsection