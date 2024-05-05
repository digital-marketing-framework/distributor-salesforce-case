<?php

namespace DigitalMarketingFramework\Distributor\SalesforceCase;

use DigitalMarketingFramework\Core\Initialization;
use DigitalMarketingFramework\Core\Registry\RegistryDomain;
use DigitalMarketingFramework\Distributor\Core\Route\OutboundRouteInterface;
use DigitalMarketingFramework\Distributor\SalesforceCase\Route\SalesforceCaseOutboundRoute;

class DistributorSalesforceCaseInitialization extends Initialization
{
    protected const PLUGINS = [
        RegistryDomain::DISTRIBUTOR => [
            OutboundRouteInterface::class => [
                SalesforceCaseOutboundRoute::class,
            ],
        ],
    ];

    protected const SCHEMA_MIGRATIONS = [];

    public function __construct(string $packageAlias = '')
    {
        parent::__construct('distributor-salesforce-case', '1.0.0', $packageAlias);
    }
}
