<?php

namespace App\Helpers\Enums;

enum AdminBooksState
{
    case tableVisible;
    case editFormVisible;
    case newBookFormVisible;
    case deleteFormVisible;
}
