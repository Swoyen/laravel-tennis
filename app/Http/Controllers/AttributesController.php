<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function dates(){
        $date = Ranking::select('date')->distinct()->get();
        return $date;
    }

    public function genders(){
        $genders = Ranking::select('gender')->distinct()->get();
        return $genders;
    }

    public function countries(){
        $genders = Ranking::select('country')->distinct()->get();
        return $genders;
    }

    public function types(){
        $genders = Ranking::select('type')->distinct()->get();
        return $genders;
    }
}
