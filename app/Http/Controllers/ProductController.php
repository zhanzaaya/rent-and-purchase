<?php

namespace App\Http\Controllers;

use App\Http\Resources\LicenseResource;
use App\Services\Product\LicenseService;
use Illuminate\Http\Request;

readonly class ProductController
{
    public function __construct(
        private LicenseService $licenseService,
    )
    {
    }

    public function status(Request $request): LicenseResource
    {
        return new LicenseResource(
            $this->licenseService->getOrCreateLicense(auth()->user(), $request->input('productId'))
        );
    }
}
