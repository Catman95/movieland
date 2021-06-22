<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class HomeController extends Controller
{
    protected $data;
    protected $model;

    public function __construct() {

    }

    public function log($label, $message) {
        $log = new Log();
        $log->insert($label, $message);
    }

}
