<?php

namespace App\Http\Controllers;

use App\Http\Resources\Sale\SaleResource;
use App\Services\Sale\SaleService;

readonly class ProductPurchaseController
{
    public function __construct(
        private SaleService $saleService,
    )
    {
    }

    public function purchase(int $productId): SaleResource
    {
        return new SaleResource($this->saleService->makeSale(auth()->user(), $productId));
    }

}
