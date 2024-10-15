<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rent\ProductRentRequest;
use App\Http\Requests\Rent\RentExtensionRequest;
use App\Http\Resources\Rent\RentResource;
use App\Models\Rent;
use App\Services\Rent\RentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductRentController extends \Illuminate\Routing\Controller
{
    public function __construct(
        private readonly RentService $rentService
    )
    {
    }

    public function rent(ProductRentRequest $request, int $productId): RentResource|RedirectResponse
    {
        return new RentResource($this->rentService->makeRent(
            auth()->user(),
            $productId,
            $request->input('rent_time_from'),
            $request->input('rent_period'))
        );
    }

    public function extendRent(RentExtensionRequest $request, int $rentId): RentResource|RedirectResponse
    {
        return new RentResource($this->rentService->extendRent(
            auth()->user(),
            $rentId,
            $request->input('extension_period'))
        );
    }
}
