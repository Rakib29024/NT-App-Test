<?php
namespace App\Repositories\PreOrder;

use App\Models\PreOrder;
use App\Repositories\PreOrder\PreOrderRepositoryInterface;

Class PreOrderRepository implements PreOrderRepositoryInterface
{
    public $PreOrder;

    public function __construct(PreOrder $PreOrder) {
        //parent::__construct($PreOrder);
        $this->PreOrder = $PreOrder;
    }
    
    public function all()
    {
        return 0;
    }


}
