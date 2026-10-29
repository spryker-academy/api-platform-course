<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Api\Storefront\Provider;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use SprykerAcademy\Client\SupplierSearch\SupplierSearchClientInterface;
use SprykerAcademy\Glue\Supplier\Processor\Mapper\SupplierMapper;
class SupplierLocationsStorefrontProvider implements ProviderInterface
{
    public function __construct(
        protected SupplierSearchClientInterface $supplierSearchClient,
    ) {
    }
    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = [],
    ): object|array|null {
        $idLocation = $uriVariables['idSupplierLocation'] ?? null;
        if (!isset($uriVariables['idSupplier'])) {
            return $idLocation === null ? [] : null;
        }
        $supplierTransfer = $this->supplierSearchClient
            ->findSupplierById((int)$uriVariables['idSupplier']);
        $locations = $supplierTransfer->getSupplierLocations();
        $supplierMapper = new SupplierMapper();
        $resources = [];
        foreach ($locations as $locationTransfer) {
            $resource = $supplierMapper
                ->mapSupplierLocationTransferToResource($locationTransfer);
            if ($resource->idSupplierLocation === (int)$idLocation) {
                return $resource;
            }
            $resources[] = $resource;
        }
        return $idLocation === null ? $resources : null;
    }
}
