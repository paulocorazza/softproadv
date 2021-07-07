@extends('site.template.page')

@section('hero')
    @include('site.template.hero')
@endsection

@section('body')
    @include('site.template.about')
    @include('site.template.feature')
    @include('site.template.tab')
    @include('site.template.pricing')
@endsection

