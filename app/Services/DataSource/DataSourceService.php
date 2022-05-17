<?php
namespace App\Services\DataSource;

use App\DataSource;

use App\Services\CRUDService;

class DataSourceService extends CRUDService
{
    public function __construct()
    {
        parent::__construct(DataSource::class);
    }
    public function list(
        $conditions = [],
        $sortBy = 'id',
        $sortOrder = 'ASC'
    ) {
        return $this->model::where($conditions)->with('actions')
            ->orderBy($sortBy, $sortOrder)->get();
    }

    public function changeStatus($id)
    {
        $connector = DataSource::find($id);
        if ($connector) {
            $connector->is_active = !$connector->is_active;
            $connector->save();
        }
    }
}
