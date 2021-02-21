<?php

namespace App\Services\Support;

interface IndexInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\LazyCollection|\Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index();
}
