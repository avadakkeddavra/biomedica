@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection

@section('main-content')
    @if(Session::has('success'))
        <div class="container-fluid spark-screen">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-primary">
                        <div class="box-body">
                            <div class="callout callout-success">
                                <h4>Success</h4>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="col-md-8">
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
                                <label for="">Родительская категория</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Нет</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
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
    <script>
        $('button').click(function(){
            var data = {
                name: $('#name').val(),
                parent_id:$('#parent_id').val()
            };
            $.ajax({
                url:"/admin/category/create",
                data:data,
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    console.log(response);
                }
            })
        });
    </script>
@endsection