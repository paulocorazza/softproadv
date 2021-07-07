@extends('site.template.master')

@section('header')
    @include('site.template.header')
@endsection

@section('content')
    <div class="page-content">
        @yield('body')
    </div>
@endsection

@section('footer')
    @include('site.template.footer')
@endsection

















