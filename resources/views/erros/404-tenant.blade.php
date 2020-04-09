@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - 404 - Page not found')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => '404 - Error Page',
                       'breadcrumbs' => [
                       'Home' => route('home'),
                       '404 - Error Page', ]
                      ])
@stop

@section('content')
    <div class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>

                <p>
                    We could not find the page you were looking for.
                 </p>


            </div>
            <!-- /.error-content -->
        </div>

    </div>
@stop








