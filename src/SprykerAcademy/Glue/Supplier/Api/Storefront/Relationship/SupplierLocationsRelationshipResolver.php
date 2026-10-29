<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Relationship;
use Spryker\ApiPlatform\Relationship\PerItemRelationshipResolverInterface;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
class SupplierLocationsRelationshipResolver
    implements PerItemRelationshipResolverInterface
{
    public function __construct(
        protected SupplierSearchClientInterface $supplierSearchClient,
    ) {
    }
    public function resolve(array $parentResources, array $context): array
    {
        $perItem = $this->resolvePerItem($parentResources, $context);
        return array_merge([], ...array_values($perItem));
    }
    public function resolvePerItem(
        array $parentResources,
        array $context,
    ): array {
        $locationsBySupplier = [];
        foreach ($parentResources as $supplierResource) {
            $locationsBySupplier[$supplierResource->idSupplier] = [];
        }
        $collection = $this->supplierSearchClient->searchSuppliers([
            SupplierSearchConfig::PARAMETER_IDS_SUPPLIER =>
                array_keys($locationsBySupplier),
        ]);
        $supplierMapper = new SupplierMapper();
        foreach ($collection->getSuppliers() as $supplierTransfer) {
            $idSupplier = $supplierTransfer->getIdSupplier();
            foreach ($supplierTransfer->getSupplierLocations() as $location) {
                $locationsBySupplier[$idSupplier][] = $supplierMapper
                    ->mapSupplierLocationTransferToResource($location);
            }
        }
        return $locationsBySupplier;
    }
}
