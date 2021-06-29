<?php
namespace App\Repositories\Product;

use App\Repositories\Product\ProductRepositoryInterface;

Class ProductRepository implements ProductRepositoryInterface
{
    public $ProductRepository;

    public function __construct(ProductRepository $ProductRepository) {
        //parent::__construct($ProductRepository);
        $this->ProductRepository = $ProductRepository;
    }


    public function all()
    {
        return 0;
    }


}
