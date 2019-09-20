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
