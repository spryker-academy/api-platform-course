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
    protected const int DEFAULT_LIMIT = 10;
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
        $supplierTransfer = $this->supplierFacade->findSupplierById((int)$idSupplier);
        if ($supplierTransfer === null) {
            return null;
        }
        return (new SupplierBackendMapper())
            ->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
    }
    protected function provideCollection(): array
    {
        $limit = $this->getPageParameter(
            'limit',
            $this->getOperation()->getPaginationItemsPerPage() ?? static::DEFAULT_LIMIT,
        );
        $offset = $this->getPageParameter('offset', 0);
        $criteria = (new SupplierCriteriaTransfer())->setPagination(
            (new PaginationTransfer())->setOffset($offset)->setLimit($limit),
        );
        $collection = $this->supplierFacade->getPaginatedSupplierCollection($criteria);
        $mapper = new SupplierBackendMapper();
        $resources = [];
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $resources[] = $mapper->mapSupplierTransferToSuppliersBackendResource($supplierTransfer);
        }
        if ($resources !== []) {
            $numFound = $collection->getPagination()?->getNbResults() ?? count($resources);
            $resources[0]->pagination = Pagination::fromArray([
                'numFound' => $numFound,
                'currentPage' => intdiv($offset, $limit) + 1,
                'maxPage' => (int)ceil($numFound / $limit),
                'currentItemsPerPage' => $limit,
            ]);
        }
        return $resources;
    }
    protected function getPageParameter(string $name, int $default): int
    {
        if (!$this->hasRequest()) {
            return $default;
        }
        $page = $this->getRequest()->query->all()['page'] ?? [];
        if (!is_array($page) || !isset($page[$name])) {
            return $default;
        }
        return max((int)$page[$name], $name === 'limit' ? 1 : 0);
    }
}
