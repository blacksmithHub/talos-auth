<?php

namespace App\Services\Support;

interface DeleteInterface
{
    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id);
}
