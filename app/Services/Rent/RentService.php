<?php

namespace App\Services\Rent;

use App\Models\DTO\ProductRentDto;
use App\Models\DTO\ProductRentExtensionDto;
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
        private RentRepository          $rentRepository,
        private RentExtensionValidation $rentExtensionValidation,
        private RentExtensionRepository $rentExtensionRepository,
    )
    {
    }

    public function makeRent(ProductRentDto $rentDto)
    {
        try {
            $this->rentValidation->validate($rentDto);

            DB::beginTransaction();

            $this->userRepository->subtractFromBalance($rentDto->user, $rentDto->getTotal());

            $rent = $this->rentRepository->createRent($rentDto);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $rent;
    }

    public function extendRent(ProductRentExtensionDto $rentExtensionDto)
    {
        try {
            $this->rentExtensionValidation->validate($rentExtensionDto);

            DB::beginTransaction();

            $this->userRepository->subtractFromBalance($rentExtensionDto->user, $rentExtensionDto->getTotal());

            $this->rentExtensionRepository->createRentExtension($rentExtensionDto);

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        $rent->refresh();
        return $rent;
    }
}
