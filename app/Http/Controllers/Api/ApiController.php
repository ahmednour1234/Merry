<?php

namespace App\Http\Controllers\Api;

use App\Support\Api\ApiResponder;
use Illuminate\Routing\Controller;

abstract class ApiController extends Controller
{
    public function __construct(protected ApiResponder $responder) {}
}
