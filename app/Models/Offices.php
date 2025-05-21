<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;

    protected $table = 'offices';
    protected $primaryKey = 'id_offi';
    protected $fillable = [
        'name_offi',
        'desc_offi',
        'status_offi'
    ];

    public function users()
    {
        return $this->hasMany(Users::class, 'id_offi');
    }

    public function documents()
    {
        return $this->hasMany(Documents::class, 'id_offi');
    }
}
