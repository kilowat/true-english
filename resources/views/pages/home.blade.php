
@extends('layouts.master')

@if($page)
    @section('title', $page->title)
    @section('description', $page->description)
@endif

@section('content')
    @if($page)
        <section class="about-block">
            {!! $page->text !!}
            <div class="support-block">
                <div class="support-row"><b>Поддержать проект:</b>
                    <iframe src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9D%D0%B0%20%D1%80%D0%B0%D0%B7%D0%B2%D0%B8%D1%82%D0%B8%D0%B5%20%D0%BF%D1%80%D0%BE%D0%B5%D0%BA%D1%82%D0%B0&default-sum=100&button-text=11&yamoney-payment-type=on&button-size=m&button-color=orange&successURL=&quickpay=small&account=410018237147676&"
                            width="184"
                            height="36"
                            frameborder="0"
                            allowtransparency="true"
                            scrolling="no"></iframe>
                </div>
            </div>
        </section>
    @endif

    @widget('TopCards')
    @widget('LastArticles')
@endsection