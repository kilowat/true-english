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