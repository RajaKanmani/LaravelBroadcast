<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UuidGenerateController extends Controller
{
    public function generate_uuid()
    {
        return Str::uuid();
    }
}
