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
        $random = rand($arrId[0],count($arrId));
        return $random;
    }
}
