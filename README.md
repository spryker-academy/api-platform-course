# Spryker Academy - Building APIs in Spryker with API Platform

The code of the video course **Building APIs in Spryker with API Platform**.

`main` is the shop the course starts from: the Supplier module suite of the Spryker Academy training
(`spryker-academy/supplier`) with its Back Office, data import, Publish & Synchronize and Elasticsearch search, and
**no API code at all**. The course builds the API step by step, and every lesson has a branch with the code it ends with.

The course teaches Spryker's API Platform only: resource schemas in YAML, generated resource classes, providers,
processors, validation schemas, pagination, relationships, sparse fieldsets, OpenAPI documentation, security
expressions and tests, on the Storefront API and on the Backend API.

## What is in the starting point

| Module | Layer | Role in the course |
|---|---|---|
| `Supplier` | Zed | Table `pyz_supplier`, transfers, facade, repository and entity manager: the data the API exposes |
| `SupplierLocation` | Zed | Table `pyz_supplier_location`: the related resource of the relationship lessons |
| `SupplierGui` | Zed | Back Office CRUD, used to look at the data |
| `SupplierDataImport` | Zed | CSV import of the sample suppliers and locations |
| `SupplierSearch`, `SupplierStorage` | Zed, Client | Publish & Synchronize to Elasticsearch and Redis: the sources of the Storefront API |

## What the course adds

- `src/SprykerAcademy/Glue/Supplier/`: `resources/api/storefront/` and `resources/api/backend/` schemas, providers,
  mappers, processors, validation schemas
- Paging in the data sources: a query expander and a result formatter in the `SupplierSearch` client, a paginated
  collection in the `Supplier` facade and repository
- `src/SprykerAcademy/Glue/GlueApplication/`: keeps the Storefront REST plugins out of the Backend API application
- `tests/SprykerAcademyTest/Zed/Supplier/GlueApi/`: the API tests

## Branches

- `main`: the starting point.
- `lesson/<NN-MM-slug>`: the code at the end of that lesson, in the order of the course.

## Requirements

- Spryker B2B Demo Marketplace release 202608.0 or later (`spryker/api-platform` 1.25 or later)
- PHP 8.3 or later, Docker SDK

## Installation in a Spryker project

The package is loaded into a project with the Academy exercise loader
([spryker-academy/instructor-exercises](https://github.com/spryker-academy/instructor-exercises)), which registers the
`SprykerAcademy` namespace, adds `src/SprykerAcademy` to the API Platform source directories and registers the
Academy Clients and Business layers as Symfony services for the providers, then imports and publishes the sample data:

```bash
git clone https://github.com/spryker-academy/instructor-exercises exercises
ACADEMY_SUPPLIER_REPO=https://github.com/spryker-academy/api-platform-course ./exercises/load.sh supplier main --run
```

To jump to the end of a lesson, load its branch instead of `main`.

## Documentation

- [API Platform in Spryker](https://docs.spryker.com/docs/integrations/spryker-api/api-platform/api-platform)
- [Resource schemas](https://docs.spryker.com/docs/integrations/spryker-api/api-platform/resource-schemas)
- [API Platform](https://api-platform.com/docs/core/)

## License

MIT, see `LICENSE`. Based on the Spryker Academy training material.
