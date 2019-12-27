
<div class="word-info">
    @if($examples)
        <div class="examples">
            @foreach($examples as $example)
                <div class="example-row">
                    <div class="en-text">{{$example->en_text}}</div>
                    <div class="ipa-text">{{ $example->ipa_text }}</div>
                    <div class="ru-text">{{ $example->ru_text }}</div>
                </div>
            @endforeach
        </div>
    @else
        Извините примеров для данного слова нет в базе словаря, мы работаем над этим.
    @endif
</div>
