<?php

namespace App\Services\Product;

use App\Repositories\LicenseRepository;
use App\Repositories\RentRepository;
use App\Repositories\SaleRepository;

readonly class LicenseService
{
    public function __construct(
        private LicenseRepository $licenseRepository,
        private SaleRepository    $saleRepository,
        private RentRepository    $rentRepository,
    )
    {
    }

    public function getOrCreateLicense($user, $productId)
    {
        if ($license = $this->licenseRepository->find($user->id, $productId)) {
            return $license;
        }

        $sale = $this->saleRepository->find($user->id, $productId);
        if ($sale) {
            return $this->licenseRepository->createFromSale($user->id, $productId, $sale);
        }

        $rent = $this->rentRepository->find($user->id, $productId);
        if ($rent) {
            return $this->licenseRepository->createFromRent($user->id, $productId, $rent);
        }

        return null;
    }
}
