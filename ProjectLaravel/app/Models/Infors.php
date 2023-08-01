<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infors extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'info_contact',
        'info_map'
    ];
    public $timestamps = false;
}
