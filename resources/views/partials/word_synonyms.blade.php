
<div class="word-info">
    @if($synonyms)
    <div class="examples">
        @foreach($synonyms as $item)
        <div class="example-row">
            <div class="en-text">{{ $item->wordRel->name }}</div>
            <div class="ipa-text">{{ $item->wordRel->transcription}}</div>
            <div class="ru-text">{{ $item->wordRel->translate }}</div>
        </div>
        @endforeach
    </div>
    @else
    Извините синонимов для данного слова нет в базе словаря, мы работаем над этим.
    @endif
</div>
