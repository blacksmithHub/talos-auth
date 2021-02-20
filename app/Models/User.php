<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'discord_id',
        'username',
        'discriminator',
        'master_key_id'
    ];

    public $keyType = 'string';

    /*
     * Get master key.
     *
     * @return \App\Models\MasterKey
     */
    public function masterKey()
    {
        return $this->belongsTo(MasterKey::class);
    }
}
