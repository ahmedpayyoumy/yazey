<?php
namespace App\Services;

class CRUDService
{
    protected $model = null;

    public function __construct($model)
    {
        $this->model = app($model);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function firstRow(
        $conditions = [],
        $sortBy = 'id',
        $sortOrder = 'ASC'
    ) {
        return $this->model::where($conditions)->first();
    }

    public function list(
        $conditions = [],
        $sortBy = 'id',
        $sortOrder = 'ASC'
    ) {
        return $this->model::where($conditions)
            ->orderBy($sortBy, $sortOrder)->get();
    }

    public function listByConditions(
        $conditions = [],
        $with = [],
        $sortBy = 'id',
        $sortOrder = 'ASC'
    ) {
        $query = $this->getModel()->where($conditions);
        if (count($with)) {
            $query->with($with);
        }
        return $query->orderBy($sortBy, $sortOrder)->get();
    }

    public function firstRowByConditions(
        $conditions = [],
        $with = []
    ) {
        $query = $this->getModel()->where($conditions);
        if (count($with)) {
            $query->with($with);
        }
        return $query->first();
    }

    public function update($conditions = [], $request)
    {
        $updated = $this->model->where($conditions)->update($request);
        if ($updated) {
            return $this->firstRow($conditions);
        }
        return 0;
    }

    public function create($request)
    {
        return $this->model::create($request);
    }

    public function updateOrCreate(array $conditions = [], array $data)
    {
        // dd($data);
        try {
            $updated = $this->model->updateOrCreate($conditions, $data);
            if ($updated) {
                return $this->firstRow($conditions);
            }
            return 0;
        } catch (\Exception $e) {
        }
    }

    public function firstOrCreate(array $conditions = [], array $data)
    {
        try {
            $result = $this->firstRow($conditions);
            if (!$result) {
                $this->create($conditions, $data);
                $result = $this->firstRow($conditions);
            }
            return $result;
        } catch (\Exception $e) {
        }

        return $this->model->firstOrCreate($conditions, $data);
    }

    public function delete($conditions = [])
    {
        return $this->model::where($conditions)->delete();
    }

    public function count($conditions = [])
    {
        return $this->model::where($conditions)->count();
    }
}
