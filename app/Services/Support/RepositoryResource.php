<?php

namespace App\Services\Support;

use Illuminate\Support\Arr;

trait RepositoryResource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\LazyCollection|\Illuminate\Http\Resources\Json\ResourceCollection
     */
    public function index()
    {
        return $this->setResponseCollection(
            $this->repository->all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(array $request)
    {
        return $this->setResponseResource(
            $this->repository->create($request)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param array $request
     * @return mixed
     */
    public function update($id, array $request)
    {
        return $this->setResponseResource(
            $this->repository->update($id, $request)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int|string $id
     * @param bool $findOrFail
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id, bool $findOrFail = true)
    {
        $data = $this->repository->find($id, $findOrFail);

        return isset($data)
            ? $this->setResponseResource($data)
            : null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
