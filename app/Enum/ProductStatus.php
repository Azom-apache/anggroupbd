<?php

namespace App\Enum;

enum ProductStatus: int
{
    use Commons;

    case InActive = 0;
    case Active = 1;
}