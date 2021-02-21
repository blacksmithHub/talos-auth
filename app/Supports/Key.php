<?php

namespace App\Supports;

use Illuminate\Support\Str;

class Key
{
    /**
     * Length of randomize characters
     *
     * @var int
     */
    protected $length = 1;

    /**
     * Generate One time used key
     * combination: random(64).uuid.random(64)
     *
     * @return String
     */
    public function generate(): String
    {
        return sprintf(
            '%s%s%s',
            Str::random($this->length),
            Str::uuid(),
            Str::random($this->length)
        );
    }
}
