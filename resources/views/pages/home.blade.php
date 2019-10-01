
@extends('layouts.master')

@if($page)
    @section('title', $page->title)
    @section('description', $page->description)
@endif

@section('content')
    @if($page)
        <section class="about-block">
            {!! $page->text !!}
        </section>
    @endif

    @widget('TopCards')
@endsection