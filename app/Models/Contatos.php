<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Contatos extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'birthdate','id_user'
    ];

    /**
     * Pega o usuário responsável por este contato
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
