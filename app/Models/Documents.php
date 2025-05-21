<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'documents';
    protected $primaryKey = 'id_doc';
    protected $fillable = [
        'num_exp',
        'id_offi',
        'created_by',
        'updated_by',
        'pdf_path',
        'status_env_doc',
        'status_doc'
    ];

    public function office()
    {
        return $this->belongsTo(Offices::class, 'id_offi');
    }

    public function creator()
    {
        return $this->belongsTo(Users::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(Users::class, 'updated_by');
    }
}
