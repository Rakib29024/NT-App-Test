<?php
namespace App\Repositories\Stock;

use App\Models\Stock;
use App\Repositories\CommonRepository;
use App\Repositories\Stock\StockRepositoryInterface;

Class StockRepository extends CommonRepository implements StockRepositoryInterface
{
    public $StockRepository;

    public function __construct(Stock $Stock) {
        parent::__construct($Stock);
        $this->Stock = $Stock;
    }


    public function relatedProducts($stock_ids)
    {
            $products=$this->all();
            $requestedProducts=$products->whereIn('id',$stock_ids);
            $productWeight=$requestedProducts->pluck('weight');
            $productTasteType=$requestedProducts->pluck('tasteType');
            return $products->whereIn('weight',$productWeight)->WhereIn('tasteType',$productTasteType)->get();
    }


}
