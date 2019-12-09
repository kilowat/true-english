    <div class="word-info">
        @if($word)
            <div class="table">
                <div class="table-row">
                    <div class="table-cell">Слово:</div>
                    <div class="table-cell word-cell">{{ $word->name }}</div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Тр-ция:</div>
                    <div class="table-cell transcript-cell">{{ $word->transcription }}</div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Перевод:</div>
                    <div class="table-cell translate-cell">{{ $word->translate }}</div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Аудио:</div>
                    <div class="table-cell">
                        @if($word->audio)
                            <audio controls><source src="{{ $word->audio->url }}" type="{{ $word->audio->mime }}"></audio>
                        @else
                            Не найден
                        @endif
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Тренинг:</div>
                    <div class="table-cell">
                        <div class="link-list">
                            @if($word->phrase_training > 0)
                                <div class="link-row">
                                    <a href="{{ route('word-training.card', $word->name) }}" onclick="localStorage.go_back=location.href"  target="_blank" title="Фразы">Фразы ({{ $word->phrase_training }})</a>
                                </div>
                            @endif
                            @if($word->listen_training > 0)
                                <div class="link-row">
                                    <a href="{{ route('word-training-sentence.card', $word->name) }}" onclick="localStorage.go_back=location.href" target="_blank" title="Фразы">Слух ({{ $word->listen_training }})</a>
                                </div>
                            @endif
                            <div class="link-row">
                                <a href="#" class="example-link" data-url="{{ route('word.example', $word->name) }}" onclick="_app.showExamples(this)" title="Примеры">Примеры</a>
                            </div>
                            <div class="link-row">
                                <a href="#" class="synonym-link" data-url="{{ route('word.synonyms', $word->name) }}" onclick="_app.showExamples(this)" title="Синонимы">Синонимы</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Ссылки:</div>
                    <div class="table-cell">
                        <div class="link-list">
                            <a href="javascript:void(0)" onclick="window.openYouglishBox('{{ $word->name }}')"><i class="icon ic-youglish"></i></a>
                            <a href="{{ $word->forvoLink }}" target="_blank" title="forvo"><i class="icon ic-forvo"></i></a>
                            <a href="{{ $word->contextReversoLink }}" target="_blank" title="reverso"><i class="icon ic-reverso"></i></a>
                            <a href="{{ $word->meriamlLink }}" target="_blank"><i class="icon ic-meriam"></i></a>
                            <a href="{{ $word->wordHuntLink }}" target="_blank"><i class="icon ic-word-hunt"></i></a>
                            <a href="{{ $word->yandexLink }}" target="_blank"><i class="icon ic-yandex"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            Извините пока данного слова нет в базе словаря, мы работаем над этим.
        @endif
    </div>