<section class="card-cmp card-top">
    <h4>Новые слова и диалоги</h4>
    <div class="row">
        @foreach($cards as $card)
            <div class="col s12 m6 l3">
                <a class="card" href="{{ $card->link }}" title="">
                    <div class="card-image">
                        <img src="{{ $card->previewPicture }}" alt="{{ $card->name }}">
                        <span class="card-title">{{ $card->name }}</span>
                    </div>
                    <div class="card-info">
                        <div class="info-cell"><svg class="ic-svg card-icon"><use xlink:href="#ic-dict" x="0" y="0"></use></svg><span class="info-value">{{ $card->words->count() }}</span></div>
                        <div class="info-cell"><span class="info-value">{{ $card->shortData }}</span></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
