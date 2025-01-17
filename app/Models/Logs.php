<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;

    protected $table = 'logs';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'username',
        'action',
        'path',
        'created_at',
        'updated_at',
    ];
}