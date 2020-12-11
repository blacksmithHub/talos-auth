<?php

namespace App\Repositories\Support;

interface UpdateInterface
{
    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param array $request
     * @return mixed
     */
    public function update($id, array $request);
}
