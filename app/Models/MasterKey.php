<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class MasterKey extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'isAvailable'
    ];

    public $keyType = 'string';

    /*
     * Get the user record.
     *
     * @return \App\Models\User
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
