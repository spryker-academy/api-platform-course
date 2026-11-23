<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Backend\Provider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierBackendMapper;
use SprykerAcademy\Zed\Supplier\Business\SupplierFacadeInterface;
class SupplierLocationsBackendProvider implements ProviderInterface
{
    public function __construct(
        protected SupplierFacadeInterface $supplierFacade,
    ) {
    }
    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = [],
    ): object|array|null {
        $criteria = new SupplierLocationCriteriaTransfer();
        if (isset($uriVariables['idSupplierLocation'])) {
            $criteria->setIdSupplierLocation((int)$uriVariables['idSupplierLocation']);
            return $this->getResources($criteria)[0] ?? null;
        }
        if (!isset($uriVariables['idSupplier'])) {
            return [];
        }
        $criteria->setFkSupplier((int)$uriVariables['idSupplier']);
        return $this->getResources($criteria);
    }
    protected function getResources(SupplierLocationCriteriaTransfer $criteria): array
    {
        $locations = $this->supplierFacade
            ->getSupplierLocationCollection($criteria)
            ->getSupplierLocations();
        $mapper = new SupplierBackendMapper();
        $resources = [];
        foreach ($locations as $locationTransfer) {
            $resources[] = $mapper->mapSupplierLocationTransferToResource($locationTransfer);
        }
        return $resources;
    }
}
