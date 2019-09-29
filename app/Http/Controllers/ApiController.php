<?php

namespace App\Http\Controllers;

use App\Models\WordCard;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function subtitle($id)
    {
        $card = WordCard::find($id);

        return $card->jsonSubtitles;
    }
}
