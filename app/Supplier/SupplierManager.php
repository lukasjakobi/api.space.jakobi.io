<?php

declare(strict_types=1);

namespace App\Supplier;

class SupplierManager
{

    private array $suppliers = [];

    public function __construct()
    {
        $this->suppliers[] = null;
    }

    /**
     * @return array
     */
    public function getSuppliers(): array
    {
        return $this->suppliers;
    }
}
