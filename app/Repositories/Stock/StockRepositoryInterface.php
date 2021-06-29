<?php
namespace App\Repositories\Stock;

use App\Repositories\CommonRepositoryInterface;

Interface StockRepositoryInterface extends CommonRepositoryInterface{
    public function relatedProducts($stock_ids);
}
