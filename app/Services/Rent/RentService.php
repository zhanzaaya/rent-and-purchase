<?php

namespace App\Services\Rent;

use App\Models\Product;
use App\Models\Rent;
use App\Models\RentStatus;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Repositories\RentExtensionRepository;
use App\Repositories\RentRepository;
use App\Repositories\UserRepository;
use App\Validation\Rent\RentExtensionValidation;
use App\Validation\Rent\RentValidation;
use Illuminate\Support\Facades\DB;

readonly class RentService
{
    public function __construct(
        private RentValidation          $rentValidation,
        private UserRepository          $userRepository,
        private ProductRepository       $productRepository,
        private RentRepository          $rentRepository,
        private RentExtensionValidation $rentExtensionValidation,
        private RentExtensionRepository $rentExtensionRepository,
    )
    {
    }

    public function makeRent(User $user, int $productId, string $rentTimeFrom, int $rentPeriod)
    {
        try {
            $product = Product::findOrFail($productId);

            $this->rentValidation->validate($user, $product, $rentTimeFrom, $rentPeriod);

            DB::beginTransaction();

            $this->productRepository->reduceProductRentalStock($product, 1);

            $this->userRepository->subtractFromBalance($user, $product->hourly_rent_price * 1);

            $rent = $this->rentRepository->createRent($user, $product, $rentTimeFrom, $rentPeriod, 1);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $rent;
    }

    public function extendRent(User $user, int $rentId, int $rentExtensionPeriod)
    {
        try {
            $rent = Rent::findOrFail($rentId);

            $this->rentExtensionValidation->validate($user, $rent, $rentExtensionPeriod);

            DB::beginTransaction();

            $extensionTotal = $rent->product_price * $rentExtensionPeriod * $rent->quantity;
            $this->userRepository->subtractFromBalance($user, $extensionTotal);

            $this->rentExtensionRepository->createRentExtension($rent, $rentExtensionPeriod, $extensionTotal);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        $rent->refresh();
        return $rent;
    }
}
