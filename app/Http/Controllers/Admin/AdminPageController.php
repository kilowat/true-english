<?php
/**
 * Created by PhpStorm.
 * User: kilowat
 * Date: 13.09.2019
 * Time: 11:12
 */

namespace App\Http\Controllers\Admin;


use App\Models\Word;
use App\Models\WordCard;
use App\Models\WordCardWord;
use App\Services\TextAnalyze\WordParser;
use Illuminate\Support\Facades\DB;

class AdminPageController extends AdminController
{

    public function index(){

        return view('admin.pages.index');
    }
}