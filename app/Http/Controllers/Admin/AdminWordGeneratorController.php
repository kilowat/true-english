<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 15.09.2019
 * Time: 8:28
 */

namespace App\Http\Controllers\Admin;


class AdminWordGeneratorController extends AdminController
{
    public function index()
    {
        return view('admin.pages.word_generator_index');
    }
}