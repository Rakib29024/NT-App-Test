<?php
namespace App\Repositories;

use App\Repositories\CommonRepositoryInterface;

class CommonRepository implements CommonRepositoryInterface
{
    public $model;

    public function __construct($model) {
        $this->model=$model;
    }

    public function find($id)
    {
        return $this->model->select($this->model->selectFormat())->find($id);
    }
    public function all()
    {
        return $this->model->select($this->model->selectFormat());
    }
    public function all_withTrashed()
    {
        return $this->model->withTrashed();
    }

    public function restore($id)
    {
        $iteam=$this->only_TrashedItem($id);
        return $iteam->restore();
    }

    public function destroy($id)
    {
        $iteam=$this->only_TrashedItem($id);
        return $iteam->forceDelete();
    }

    public function only_TrashedItem($id){
        return $this->model->onlyTrashed()->findOrFail($id);
    }
}
