<?php
declare(strict_types=1);
namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\QueryExpander;
use Elastica\Query\Terms;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
class SupplierIdsQueryExpanderPlugin extends AbstractPlugin
    implements QueryExpanderPluginInterface
{
    public function expandQuery(
        QueryInterface $searchQuery,
        array $requestParameters = [],
    ) {
        $idsKey = SupplierSearchConfig::PARAMETER_IDS_SUPPLIER;
        $ids = array_values($requestParameters[$idsKey] ?? []);
        if ($ids === []) {
            return $searchQuery;
        }
        $query = $searchQuery->getSearchQuery();
        $idField = SupplierSearchConfig::KEY_ID_SUPPLIER;
        $query->setQuery(new Terms($idField, $ids));
        $query->setSize(count($ids));
        return $searchQuery;
    }
}
