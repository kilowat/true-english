<section class="card-cmp card-top article">
    <h4>Новые статьи</h4>
    <div class="row">
        @foreach($articles as $article)
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image">
                        <img src="{{ $article->previewPicture }}" alt="{{ $article->name }}">
                        <span class="card-title">{{ $article->name }}</span>
                    </div>
                    <div class="card-content">
                        {!! $article->previewText !!}
                    </div>
                    <div class="card-action">
                        <a href="{{ route("article.detail", $article->code) }}" class="btn">Подробнее</a>
                        <span class="data-created">{{ $article->shortDate }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
