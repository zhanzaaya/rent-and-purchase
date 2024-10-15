<?php

namespace App\Services\Sale;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Repositories\SaleItemRepository;
use App\Repositories\SaleRepository;
use App\Repositories\UserRepository;
use App\Validation\Sale\SaleValidation;
use Illuminate\Support\Facades\DB;

class SaleService
{
    public function __construct(
        private readonly SaleValidation     $saleValidation,
        private readonly UserRepository     $userRepository,
        private readonly SaleRepository     $saleRepository,
        private readonly SaleItemRepository $saleItemRepository,
        private readonly ProductRepository  $productRepository,
    )
    {
    }

    public function makeSale(User $user, int $productId): Sale
    {
        try {
            $product = Product::findOrFail($productId);

            $this->saleValidation->validate($user, $product);

            DB::beginTransaction();

            // update balance
            $this->userRepository->subtractFromBalance($user, $product->price);
            // create sale record
            $sale = $this->saleRepository->createSale(auth()->id(), $product->price);
            // create sale item record
            $this->saleItemRepository->createSaleItem($sale->id, $product->id, $product->price, 1);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $sale;
    }
}
