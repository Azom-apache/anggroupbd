<?php

namespace App\Enum;

enum CommonStatus: int
{
    use Commons;

    case InActive = 1;
    case Active = 0;
}