<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 13.09.2019
 * Time: 11:12
 */

namespace App\Http\Controllers\Admin;


class AdminPageController extends AdminController
{

    public function index(){
        return view('admin.pages.index');
    }
}