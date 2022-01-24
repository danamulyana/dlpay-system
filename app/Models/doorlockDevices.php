<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class doorlockDevices extends Model
{
    use HasFactory;

    protected $table = 'doorlock_devices';

    protected $fillable = [
        'uid',
        'name',
        'type',
        'access_type',
        'access_mode',
        'createdBy',
        'updatedBy',
    ];

    public function privelage() : BelongsToMany
    {
        return $this->belongsToMany(
            memployee::class,
            'doorlock_has_employees',
            'doorlock_id',
            'memployes_id'
        );
    }
    public function remarks() : BelongsToMany
    {
        return $this->belongsToMany(
            mpriset::class,
            'doorlock_has_priset',
            'doorlock_id',
            'priset_id'
        );
    }
    public function Location() : BelongsTo
    {
        return $this->belongsTo(dataLocation::class,'location_id');
    }
    public function Departement() : BelongsTo
    {
        return $this->belongsTo(mdepartement::class, 'departement_id');
    }
    public function schadule() : BelongsToMany
    {
        return $this->belongsToMany(
            Schadule::class,
            'schadules_doorlock',
            'doorlock_id',
            'schadules_id',
        );
    }
}
