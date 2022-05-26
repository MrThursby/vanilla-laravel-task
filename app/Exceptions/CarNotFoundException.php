<?php

namespace App\Exceptions;

use Exception;

class CarNotFoundException extends Exception
{
    protected $message = "Car not found";
}
