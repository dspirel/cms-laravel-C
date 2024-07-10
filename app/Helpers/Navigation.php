<?php

namespace App\Helpers;

use App\Models\Navigation as ModelsNavigation;

class Navigation{
    public static function getLinks(){
        //dd(ModelsNavigation::get());
        return ModelsNavigation::get();
    }
}
