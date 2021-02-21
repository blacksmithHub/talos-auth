<?php

namespace App\Services\Contracts;

interface ServiceInterface
{
    /**
     * Repository instance of the service.
     * 
     * @return \App\Repositories\Repository
     */
    public function repository();

    /**
     * Format the response for API collection.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseCollection($data);

    /**
     * Format the response for API resource.
     *
     * @param mixed $data
     * @return \Illuminate\Http\Response
     */
    public function setResponseResource($data);
}
