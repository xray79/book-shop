<?php

namespace App\Helpers;

use App\Models\User;

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
        // turns text to all lower case and
        // replaces spaces ' ' with dashes '-' (kebab case)

        return str_replace(' ', '-', strtolower($name));
    }

    public static function mapId($userId)
    {
        // takes and arbitrary user id and maps to a range between 1-70
        // pravatar only has 70 images, must map all users to one of 70 images

        $numUsers = User::all()->count();
        return floor($userId / $numUsers * 70);
    }

    public static function renameAttribute(string $oldName, string $newName, array $attributes): array
    {
        // take old name, change to new name, on array $attributes

        $attributes[$newName] = $attributes[$oldName];
        unset($attributes[$oldName]);

        return $attributes;
    }
}
