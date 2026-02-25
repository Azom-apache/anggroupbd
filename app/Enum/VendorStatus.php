<?php

namespace App\Enum;

enum VendorStatus: int
{
    use Commons;

    case InActive = 0;
    case Active = 1;
}