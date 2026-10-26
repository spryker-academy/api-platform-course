<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;
use Generated\Api\Storefront\Suppliers\SuppliersPaginationStorefrontObject;
use Spryker\ApiPlatform\State\Provider\AbstractStorefrontProvider;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
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
        $limit = $this->getPaginationLimit();
        $offset = $this->getPaginationOffset();
        $collection = $this->supplierSearchClient
            ->searchSuppliers([
                SupplierSearchConfig::PARAMETER_OFFSET => $offset,
                SupplierSearchConfig::PARAMETER_LIMIT => $limit,
            ]);
        $supplierMapper = new SupplierMapper();
        $resources = [];
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $resources[] = $supplierMapper
                ->mapSupplierTransferToSuppliersStorefrontResource($supplierTransfer);
        }
        if ($resources !== []) {
            $total = $collection->getPagination()?->getNbResults() ?? 0;
            $page = $this->calculatePagination($offset, $limit, $total);
            $resources[0]->pagination =
                SuppliersPaginationStorefrontObject::fromArray($page);
        }
        return $resources;
    }
}
