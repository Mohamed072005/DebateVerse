<?php

namespace App\serveces;

use App\serveces\SuggestionServiceInterface;

class SuggestionService implements SuggestionServiceInterface
{

    public function getAdminsIdByRandom(object $adminsId)
    {
        // TODO: Implement getAdminsIdByRandom() method.
        foreach ($adminsId as $admin) {
            $arrId[] = $admin->id;
        }
        $endArray = count($arrId) - 1;
        $random = rand(0,$endArray);
        return $arrId[$random];
    }
}
