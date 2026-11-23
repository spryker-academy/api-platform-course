<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;
use Generated\Api\Backend\Pagination;
use Generated\Shared\Transfer\PaginationTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Spryker\ApiPlatform\State\Provider\AbstractBackendProvider;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierBackendMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
class SuppliersBackendProvider extends AbstractBackendProvider
{
    public function __construct(
        protected SupplierFacadeInterface $supplierFacade,
    ) {
    }
    protected function provideItem(): ?object
    {
        $idSupplier = $this->getUriVariables()['idSupplier'] ?? null;
        if ($idSupplier === null) {
            return null;
        }
        $supplierTransfer = $this->supplierFacade
            ->findSupplierById((int)$idSupplier);
        if ($supplierTransfer === null) {
            return null;
        }
        return (new SupplierBackendMapper())
            ->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
    }
    protected function provideCollection(): array
    {
        $limit = $this->getPaginationLimit();
        $offset = $this->getPaginationOffset();
        $criteria = (new SupplierCriteriaTransfer())->setPagination(
            (new PaginationTransfer())->setOffset($offset)->setLimit($limit),
        );
        $collection = $this->supplierFacade
            ->getPaginatedSupplierCollection($criteria);
        $mapper = new SupplierBackendMapper();
        $resources = [];
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $resources[] = $mapper
                ->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
        }
        if ($resources !== []) {
            $total = $collection->getPagination()?->getNbResults() ?? 0;
            $page = $this->calculatePagination($offset, $limit, $total);
            $resources[0]->pagination = Pagination::fromArray($page);
        }
        return $resources;
    }
}
