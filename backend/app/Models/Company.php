<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sector',
        'phone',
        'email',
        'website',
        'logo',
        'address',
        'city',
        'province',
    ];

    /**
     * Obtener los usuarios asociados a la empresa.
     * Relación 1:N (Una empresa tiene muchos usuarios).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}