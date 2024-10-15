<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rent\ProductRentRequest;
use App\Http\Requests\Rent\RentExtensionRequest;
use App\Http\Resources\Rent\RentResource;
use App\Models\DTO\ProductRentDto;
use App\Models\DTO\ProductRentExtensionDto;
use App\Services\Rent\RentService;

class ProductRentController extends \Illuminate\Routing\Controller
{
    public function __construct(
        private readonly RentService $rentService
    )
    {
    }

    public function rent(ProductRentRequest $request): RentResource
    {
        $rentDto = ProductRentDto::fromArray($request->validated());

        return new RentResource($this->rentService->makeRent($rentDto));
    }

    public function extendRent(RentExtensionRequest $request): RentResource
    {
        $rentExtensionDto = ProductRentExtensionDto::fromArray($request->validated());

        return new RentResource($this->rentService->extendRent($rentExtensionDto));
    }
}
