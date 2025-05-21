<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'name_user',
        'ape_pat_user',
        'ape_mat_user',
        'dni_user',
        'nick_user',
        'password',
        'level_user',
        'id_offi',
        'status_user'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function office()
    {
        return $this->belongsTo(Offices::class, 'id_offi');
    }

    public function documentsCreated()
    {
        return $this->hasMany(Documents::class, 'created_by');
    }

    public function documentsUpdated()
    {
        return $this->hasMany(Documents::class, 'updated_by');
    }
}
