@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
@stop

@section('title_postfix', ' - Cadastrar Novo Modelo de Contrato')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                               'breadcrumbs' => [
                               'Modelo de Contrato' => route('contracts.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Modelo de Contrato</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.contracts.partials.form')
        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src={{ asset('assets/js/contracts/validation.js') }}></script>
    <script src="{{ asset('assets/ckeditor.js') }} "></script>
    <script src=" {{ asset('assets/ckfinder/ckfinder.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) , {
                ckfinder: {
                    uploadUrl: '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'numberedList', 'bulletedList', 'blockQuote', '|', 'link', '|', 'insertTable', '|', 'indent', 'outdent' ]
            })
            .then( editor => {
                //  editor.ui.view.editable.element.style.height = '150px';
            })
            .catch( error => {
                console.error( error );
            } );
    </script>
@stop


