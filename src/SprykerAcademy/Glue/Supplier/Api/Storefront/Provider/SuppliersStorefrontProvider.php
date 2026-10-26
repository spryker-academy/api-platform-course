<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
class SuppliersStorefrontProvider extends AbstractStorefrontProvider
{
    public function __construct(
        protected SupplierSearchClientInterface $supplierSearchClient,
    ) {
    }
    protected function provideItem(): ?object
    {
        $idSupplier = $this->findUriVariable('idSupplier');
        if ($idSupplier === null) {
            return null;
        }
        $supplierTransfer = $this->supplierSearchClient
            ->findSupplierById((int)$idSupplier);
        if ($supplierTransfer->getIdSupplier() === null) {
            return null;
        }
        return (new SupplierMapper())
            ->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
    }
    protected function provideCollection(): array
    {
        $collection = $this->supplierSearchClient
            ->searchSuppliers();
        $supplierMapper = new SupplierMapper();
        $resources = [];
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierMapper
                ->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
        }
        return $resources;
    }
}
