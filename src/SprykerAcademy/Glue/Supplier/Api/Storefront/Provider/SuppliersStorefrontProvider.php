<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
class SuppliersStorefrontProvider extends AbstractStorefrontProvider
{
    public function __construct(
        protected SupplierSearchClientInterface $supplierSearchClient,
    ) {
    }
    protected function provideItem(): ?object
    {
        $idSupplier = $this->getUriVariables()['idSupplier'] ?? null;
        if ($idSupplier === null) {
            return null;
        }
        $supplierTransfer = $this->supplierSearchClient
            ->findSupplierById((int)$idSupplier);
        if ($supplierTransfer->getIdSupplier() === null) {
            return null;
        }
        return SuppliersStorefrontResource::fromArray(
            $supplierTransfer->toArray(false, true),
        );
    }
    protected function provideCollection(): array
    {
        $collection = $this->supplierSearchClient
            ->searchSuppliers();
        $resources = [];
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $resources[] = SuppliersStorefrontResource::fromArray(
                $supplierTransfer->toArray(false, true),
            );
        }
        return $resources;
    }
}
