<?php
namespace App\Repositories\PreOrder;

use App\Repositories\PreOrder\PreOrderRepositoryInterface;

Class PreOrderRepository implements PreOrderRepositoryInterface
{
    public $PreOrderRepository;

    public function __construct(PreOrderRepository $PreOrderRepository) {
        //parent::__construct($PreOrderRepository);
        $this->PreOrderRepository = $PreOrderRepository;
    }


    public function all()
    {
        return 0;
    }


}
