<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('word-collections/{uri}.html', 'WordCollectionController@detail')
    ->where('uri', '[0-9a-zA-Z_/-]+')
    ->name('word-collection.detail');
Route::get('word-collections/excel-file/{id}', 'WordCollectionController@tableFileDownload')->name('word-collection.excel-download');
Route::get('word-collections/word-table/{card_id}', 'WordCollectionController@wordTable')->name('word-collection.table');
Route::get('word-collections/word-table-data/{card_id}', 'WordCollectionController@wordTableData')->name('word-collection.table-data');
Route::get('word-collections/{parent_code}/{section_code}', 'WordCollectionController@elements')->name('word-collection.elements');
Route::get('word-collections/{section_code}', 'WordCollectionController@section')->name('word-collection.section');
Route::get('word-collections', 'WordCollectionController@index')->name('word-collection.index');
Route::get('word/{code}', 'WordController@show')->name('word.show');


Route::get('grammar', 'GrammarController@index')->name('grammar.index');
Route::get('grammar/{section}', 'GrammarController@section')->name('grammar.section');
Route::get('grammar/{section_code}/{code}.html', 'GrammarController@detail')->name('grammar.detail');

Route::get('prononciation', 'PrononsController@index')->name('prononciation.index');
Route::get('prononciation/{code}.html', 'PrononsController@detail')->name('prononciation.detail');

Route::get('anki', 'AnkiCardController@index')->name('anki.index');
Route::get('anki/tag/{name}', 'AnkiCardController@index')->name('anki.index.tag');

Route::get('articles', 'ArticleController@index')->name('article.index');

Route::get('articles/tag/{name}', 'ArticleController@index')->name('article.index.tag');
Route::get('articles/{code}.html', 'ArticleController@detail')->name('article.detail');

Route::get('word-training/{word}', 'WordTrainingController@index')->name('word-training.card');
Route::get('word-training/phrase/{word}', 'WordTrainingController@ajaxGetPhrase')->name('word-training.phrase');
Route::get('/api/subtitle/id/{id}', 'ApiController@subtitle')->name('api.subtitle');
Route::get('/api/words/id/{id}', 'ApiController@words')->name('api.words');
Route::get('/api/words-table/id/{id}', 'ApiController@wordTableResource')->name('api.table-words');
Route::get('/api/text-words/id/{id}', 'ApiController@textWords')->name('api.text-words');

Route::get('misc', 'PageController@misc')->name('page.misc');

Route::get('/', 'PageController@home')->name('page.home');


Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'AdminPageController@index')->name('admin.index');

    /*******word-collection******/
    Route::get('word-collection-sections', 'AdminWordCollectionController@index')->name('admin.word-collection-sections.index');
    Route::get('word-collection-sections/edit/{id}', 'AdminWordCollectionController@edit')->name('admin.word-collection-sections.edit');
    Route::post('word-collection-sections/update/{id}', 'AdminWordCollectionController@update')->name('admin.word-collection-sections.update');
    Route::get('word-collection-sections/delete/{id}', 'AdminWordCollectionController@delete')->name('admin.word-collection-sections.delete');
    Route::get('word-collection-sections/add', 'AdminWordCollectionController@addSection')->name('admin.word-collection-sections.addSection');
    Route::post('word-collection-sections', 'AdminWordCollectionController@store')->name('admin.word-collection-sections.store');
    /***************************/

    /*******card******/
    Route::get('cards', 'AdminCardController@index')->name('admin.card.index');
    Route::get('cards/data-list', 'AdminCardController@dataList')->name('admin.card.data-list');
    Route::post('cards', 'AdminCardController@store')->name('admin.card.store');
    Route::get('cards/add', 'AdminCardController@add')->name('admin.card.add');
    Route::get('cards/show/{id}', 'AdminCardController@show')->name('admin.card.show');
    Route::get('cards/edit/{id}', 'AdminCardController@edit')->name('admin.card.edit');
    Route::get('cards/delete/{id}', 'AdminCardController@delete')->name('admin.card.delete');
    Route::post('cards/update/{id}', 'AdminCardController@update')->name('admin.card.update');
    /***************************/

    /*******word********/
    Route::get('words', 'AdminWordController@index')->name('admin.word.index');
    Route::get('words/add', 'AdminWordController@add')->name('admin.word.add');
    Route::post('words/add', 'AdminWordController@store')->name('admin.word.store');
    Route::get('words/data-list', 'AdminWordController@dataList')->name('admin.word.data-list');
    Route::get('words/edit/{id}', 'AdminWordController@edit')->name('admin.word.edit');
    Route::post('words/update/{id}', 'AdminWordController@update')->name('admin.word.update');
    Route::post('words/checkUpdate/{id}', 'AdminWordController@checkUpdate')->name('admin.word.check-update');
    Route::get('words/delete/{id}', 'AdminWordController@delete')->name('admin.word.delete');
    Route::post('words/export', 'AdminWordController@export')->name('admin.word.export');
    Route::post('words/import', 'AdminWordController@import')->name('admin.word.import');
    /******************/

    /**********audio files****************/
    Route::get('words/audio', 'AdminAudioController@index')->name('admin.audio.index');
    Route::post('words/audio', 'AdminAudioController@zip')->name('admin.audio.zip');
    Route::get('words/audio/add', 'AdminAudioController@add')->name('admin.audio.add');
    Route::get('words/audio/data-list', 'AdminAudioController@dataList')->name('admin.audio.data-list');
    Route::post('words/audio/upload-file', 'AdminAudioController@uploadFile')->name('admin.audio.upload-file');
    Route::get('words/audio/delete/{id}', 'AdminAudioController@delete')->name('admin.audio.delete');
    /************************

    /*******word generator********/
    Route::get('word-generator', 'AdminWordGeneratorController@index')->name('admin.word-generator.index');
    /******************/

    /**********articles*******************/
    Route::get('article', 'AdminArticleController@index')->name('admin.article.index');
    Route::get('article/show/{id}', 'AdminArticleController@show')->name('admin.article.show');
    Route::get('article/add', 'AdminArticleController@add')->name('admin.article.add');
    Route::post('article/add', 'AdminArticleController@store')->name('admin.article.store');
    Route::get('article/edit/{id}', 'AdminArticleController@edit')->name('admin.article.edit');
    Route::post('article/update/{id}', 'AdminArticleController@update')->name('admin.article.update');
    Route::get('article/data-list', 'AdminArticleController@dataList')->name('admin.article.data-list');
    Route::get('article/delete/{id}', 'AdminArticleController@delete')->name('admin.article.delete');
     /****************************/

    /**********anki*******************/
    Route::get('anki', 'AdminAnkiController@index')->name('admin.anki.index');
    Route::get('anki/add', 'AdminAnkiController@add')->name('admin.anki.add');
    Route::post('anki/add', 'AdminAnkiController@store')->name('admin.anki.store');
    Route::get('anki/edit/{id}', 'AdminAnkiController@edit')->name('admin.anki.edit');
    Route::post('anki/update/{id}', 'AdminAnkiController@update')->name('admin.anki.update');
    Route::get('anki/data-list', 'AdminAnkiController@dataList')->name('admin.anki.data-list');
    Route::get('anki/delete/{id}', 'AdminAnkiController@delete')->name('admin.anki.delete');
    /****************************/

    /**********grammar sections*******************/
    Route::get('grammar/section', 'AdminGrammarSectionController@index')->name('admin.grammar-section.index');
    Route::get('grammar/section/section/data-list', 'AdminGrammarSectionController@dataList')->name('admin.grammar-section.data-list');
    Route::get('grammar/section/add', 'AdminGrammarSectionController@add')->name('admin.grammar-section.add');
    Route::post('grammar/section/add', 'AdminGrammarSectionController@store')->name('admin.grammar-section.store');
    Route::get('grammar/section/edit/{id}', 'AdminGrammarSectionController@edit')->name('admin.grammar-section.edit');
    Route::post('grammar/section/update/{id}', 'AdminGrammarSectionController@update')->name('admin.grammar-section.update');
    Route::get('grammar/section/delete/{id}', 'AdminGrammarSectionController@delete')->name('admin.grammar-section.delete');
    /****************************/

    /**********grammar elements*******************/
    Route::get('grammar/element', 'AdminGrammarElementController@index')->name('admin.grammar-element.index');
    Route::get('grammar/element/show/{id}', 'AdminGrammarElementController@show')->name('admin.grammar-element.show');
    Route::get('grammar/element/section/data-list', 'AdminGrammarElementController@dataList')->name('admin.grammar-element.data-list');
    Route::get('grammar/element/add', 'AdminGrammarElementController@add')->name('admin.grammar-element.add');
    Route::post('grammar/element/add', 'AdminGrammarElementController@store')->name('admin.grammar-element.store');
    Route::get('grammar/element/edit/{id}', 'AdminGrammarElementController@edit')->name('admin.grammar-element.edit');
    Route::post('grammar/element/update/{id}', 'AdminGrammarElementController@update')->name('admin.grammar-element.update');
    Route::get('grammar/element/delete/{id}', 'AdminGrammarElementController@delete')->name('admin.grammar-element.delete');
    /****************************/


    /**********pronons*******************/
    Route::get('pronons', 'AdminPrononsController@index')->name('admin.pronons.index');
    Route::get('pronons/show/{id}', 'AdminPrononsController@show')->name('admin.pronons.show');
    Route::get('pronons/data-list', 'AdminPrononsController@dataList')->name('admin.pronons.data-list');
    Route::get('pronons/add', 'AdminPrononsController@add')->name('admin.pronons.add');
    Route::post('pronons/add', 'AdminPrononsController@store')->name('admin.pronons.store');
    Route::get('pronons/edit/{id}', 'AdminPrononsController@edit')->name('admin.pronons.edit');
    Route::post('pronons/update/{id}', 'AdminPrononsController@update')->name('admin.pronons.update');
    Route::get('pronons/delete/{id}', 'AdminPrononsController@delete')->name('admin.pronons.delete');
    /****************************/

    /***************pages*****************************/
    Route::get('page', 'AdminPageController@index')->name('admin.page.index');
    Route::get('page/add', 'AdminPageController@add')->name('admin.page.add');
    Route::post('page/add', 'AdminPageController@store')->name('admin.page.store');
    Route::get('page/edit/{id}', 'AdminPageController@edit')->name('admin.page.edit');
    Route::post('page/update/{id}', 'AdminPageController@update')->name('admin.page.update');
    Route::get('page/data-list', 'AdminPageController@dataList')->name('admin.page.data-list');
    Route::get('page/delete/{id}', 'AdminPageController@delete')->name('admin.page.delete');

    /******************settings********************/

    Route::get('settings/clear-cache', 'AdminSettingsController@clearCache')->name('admin.settings.clear-cache');

    /*************************************************/
    Route::get('/', 'AdminPageController@main')->name('admin.page.main');
    Route::get('admin/login', 'AdminAuthController@login')->name('admin.login');

});

Auth::routes();


