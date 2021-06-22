<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public function insert($label, $message) {
        \DB::table('logs')->insert([
           'label' => $label,
           'message' => $message,
           'ip_address' => $_SERVER['REMOTE_ADDR']
        ]);
    }


}
