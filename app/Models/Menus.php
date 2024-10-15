<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'path',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];
}