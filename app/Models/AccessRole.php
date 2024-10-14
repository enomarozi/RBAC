<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRole extends Model
{
    use HasFactory;

    protected $table = 'access_roles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user',
        'role',
        'permission',
        'description',
        'created_at',
        'updated_at',
    ];
}
