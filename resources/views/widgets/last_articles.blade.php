<section class="card-cmp card-top article">
    <h4>Новые статьи</h4>
    <div class="row">
        @foreach($articles as $article)
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-image">
                        <a href="{{ route("article.detail", $article->code) }}" title="{{ $article->name }}">
                            <img src="{{ $article->previewPicture }}" alt="{{ $article->name }}">
                        </a>
                        <span class="card-title">{{ $article->name }}</span>
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
