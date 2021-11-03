<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class msubdepartement extends Model
{
    use HasFactory;

    protected $table = 'msubdepartements';

    protected $fillable = [
        'nama',
        'createdBy',
        'updatedBy',
    ];

    public function departement() : BelongsTo
    {
        return $this->belongsTo(mdepartement::class,'departement_id');
    }
    public function karyawan() : HasMany
    {
        return $this->hasMany(memployee::class);
    }
}
