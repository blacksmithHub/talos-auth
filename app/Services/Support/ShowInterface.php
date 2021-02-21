<?php

namespace App\Services\Support;

interface ShowInterface
{
    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @param bool $findOrFail
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id, bool $findOrFail = true);
}
