<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $guarded = [];

    protected $dates = [
        'data_publicacao',
    ];
}
