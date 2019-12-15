
<div class="word-info">
    @if($examples)
        <div class="examples">
            @foreach($examples as $example)
                <div class="example-row">
                    <div class="en-text"><span class="s-link">{{$example->en_text}}</span></div>
                    <div class="ipa-text">{{ $example->ipa_text }}</div>
                    <div class="ru-text">{{ $example->ru_text }}</div>
                </div>
            @endforeach
        </div>
    @else
        Извините примеров для данного слова нет в базе словаря, мы работаем над этим.
    @endif
</div>
