<?php

Breadcrumbs::for('word_collections', function ($trail) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Сборник коллекций', route('word-collection.index'));
});

Breadcrumbs::for('word_section', function ($trail, $section) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Сборник коллекций', route('word-collection.index'));
    $trail->push($section->name);
});
Breadcrumbs::for('card', function ($trail, $section, $card) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Сборник коллекций', route('word-collection.index'));
    $trail->push($section->name, route('word-collection.section', $section->uri));
    $trail->push($card->name);
});
Breadcrumbs::for('grammar', function ($trail) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Грамматика');
});
Breadcrumbs::for('grammar_section', function ($trail, $section) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Грамматика', route("grammar.index"));
    $trail->push($section->name);
});
Breadcrumbs::for('grammar_detail', function ($trail, $section, $grammar) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Грамматика', route("grammar.index"));
    $trail->push($section->name, route("grammar.section", $section->code));
    $trail->push($grammar->name);
});
Breadcrumbs::for('anki', function ($trail) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Колоды Anki');
});
Breadcrumbs::for('article_index', function ($trail) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Статьи');
});
Breadcrumbs::for('article_detail', function ($trail, $article) {
    $trail->push('Главная', route('page.home'));
    $trail->push('Статьи', route('article.index'));
    $trail->push($article->name);
});