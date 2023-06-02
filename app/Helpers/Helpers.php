<?php

namespace App\Helpers;

class Helpers
{
    public static function getId()
    {
        // returns id by reading uri, splitting based on / and returning the last el of array

        $strArr = (explode('/', request()->getUri()));
        $lastElement = end($strArr);
        return $lastElement;
    }

    public static function sanitizeName($name)
    {
        // turns text to all lower case
        // replaces spaces with - (kebab case)

        return str_replace(' ', '-', strtolower($name));
    }

    public static function mapId($user_id, $num_users)
    {
        // takes the current user id and maps to a range between 0-70
        // pravatar only has 70 images, must map all users to one of 70 images

        return floor($user_id / $num_users * 70);
    }
}
