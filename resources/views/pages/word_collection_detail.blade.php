@extends('layouts.master')

@section('title', 'Page Title')

@section('sidebar')
    <aside class="sidebar">
        {{ Widget::run('CollectionWordMenu') }}
        {{ Widget::run('AdsBlock') }}
    </aside>
@endsection

@section('sidebar-class', 'with-sidebar')


@section('content')
    <?$count = ($word_list->currentPage() * $word_list->perPage()) - $word_list->perPage() + 1; //dd($word_list)?>
    @foreach($word_list as $word)
        <?$count++;?>
    @endforeach

    <div class="nav-pagen">
        {{ $word_list->links() }}
    </div>
</section>
@endsection