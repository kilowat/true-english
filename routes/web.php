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

Route::get('word-collections', 'WordCollectionController@list')->name('word-collection.list');
Route::get('word-collections/{parent_section_code}/{current_section_code}/{element_code}.html', 'WordCollectionController@detail')->name('word-collection.detail');
Route::get('word-collections/{parent_code}/{section_code}', 'WordCollectionController@elements')->name('word-collection.elements');
Route::get('word-collections/{section_code}', 'WordCollectionController@section')->name('word-collection.section');

Route::get('/', 'PageController@home')->name('page.home');

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'AdminPageController@index')->name('admin.index');

    /*******word-collection******/
    Route::get('word-collection-sections', 'AdminWordCollectionController@index')->name('admin.word-collection-sections.index');
    Route::get('word-collection-sections/add', 'AdminWordCollectionController@addSection')->name('admin.word-collection-sections.addSection');
    Route::post('word-collection-sections', 'AdminWordCollectionController@store')->name('admin.word-collection-sections.store');
    /***************************/

    /*******card******/
    Route::get('cards', 'AdminCardController@index')->name('admin.card.index');
    Route::post('cards', 'AdminCardController@store')->name('admin.card.store');
    Route::get('cards/add', 'AdminCardController@add')->name('admin.card.add');
    /***************************/

    /*******word********/
    Route::get('words', 'AdminWordController@index')->name('admin.word.index');
    Route::get('words/data-list', 'AdminWordController@dataList')->name('admin.word.data-list');
    Route::post('words/export', 'AdminWordController@export')->name('admin.word.export');
    Route::post('words/import', 'AdminWordController@import')->name('admin.word.import');
    /******************/

    /*******word generator********/
    Route::get('word-generator', 'AdminWordGeneratorController@index')->name('admin.word-generator.index');
    /******************/

    Route::get('admin/login', 'AdminAuthController@login')->name('admin.login');

});

Auth::routes();

