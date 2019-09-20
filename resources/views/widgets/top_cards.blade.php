<section class="card-cmp card-top">
    <h4>Новые сборники слов</h4>
    <div class="row">
        @foreach($cards as $card)
            <div class="col s12 m6 l3">
                <a class="card" href="{{ $card->link }}" title="">
                    <div class="card-image">
                        <img src="{{ $card->previewPicture }}">
                        <span class="card-title">{{ $card->name }}</span>
                    </div>
                    <div class="card-info">
                        <div class="info-cell"><svg class="ic-svg card-icon"><use xlink:href="#ic-dict" x="0" y="0"></use></svg><span class="info-value">{{ $card->words->count() }}</span></div>
                        <div class="info-cell"><i class="material-icons">visibility</i><span class="info-value">1000</span></div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
