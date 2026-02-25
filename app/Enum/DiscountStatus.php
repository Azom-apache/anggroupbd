<?php

namespace App\Enum;

enum DiscountStatus: int
{
    use Commons;

    case Available = 0;
    case Upcoming = 1;

}