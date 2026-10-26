<?php
declare(strict_types=1);
namespace SprykerAcademy\Client\SupplierSearch\Plugin\Elasticsearch\QueryExpander;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use SprykerAcademy\Shared\SupplierSearch\SupplierSearchConfig;
class SupplierPaginationQueryExpanderPlugin extends AbstractPlugin
    implements QueryExpanderPluginInterface
{
    public function expandQuery(
        QueryInterface $searchQuery,
        array $requestParameters = [],
    ) {
        $query = $searchQuery->getSearchQuery();
        $query->setSort([SupplierSearchConfig::KEY_ID_SUPPLIER => 'asc']);
        $limitKey = SupplierSearchConfig::PARAMETER_LIMIT;
        if (!isset($requestParameters[$limitKey])) {
            return $searchQuery;
        }
        $offsetKey = SupplierSearchConfig::PARAMETER_OFFSET;
        $query->setFrom((int)($requestParameters[$offsetKey] ?? 0));
        $query->setSize((int)$requestParameters[$limitKey]);
        return $searchQuery;
    }
}
