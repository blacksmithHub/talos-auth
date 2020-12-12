<?php

namespace App\Repositories\Support;

trait Resource
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\LazyCollection
     */
    public function all()
    {
        $data = $this->model->cursor();

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $request)
    {
        $data = $this->model->create($request);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id, array $request)
    {
        $model = $this->model->findOrFail($id);

        $model->update($request);

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, bool $findOrFail = true)
    {
        $data = $findOrFail ? $this->model->findOrFail($id) : $this->model->find($id);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return 1;
    }
}
