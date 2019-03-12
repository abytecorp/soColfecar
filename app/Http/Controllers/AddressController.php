<?php

namespace soColfecar\Http\Controllers;

use Illuminate\Http\Request;
use soColfecar\Nomenclature;
use soColfecar\Digit;
use soColfecar\Add_letter;

class AddressController extends Controller
{
    public function getNomenclatures() 
    {
        $nomenclatures = Nomenclature::all();
        return $nomenclatures;
    }
    public function getDigits()
    {
        $digits = Digit::all();
        return $digits;
    }
    public function getAddLetters()
    {
        $add_letters = Add_letter::all();
        return $add_letters;
    }
}


