<?php

namespace DigitalMarketingFramework\Distributor\SalesforceCase\Route;

use DigitalMarketingFramework\Core\ConfigurationDocument\SchemaDocument\Schema\ContainerSchema;
use DigitalMarketingFramework\Core\ConfigurationDocument\SchemaDocument\Schema\SchemaInterface;
use DigitalMarketingFramework\Core\ConfigurationDocument\SchemaDocument\Schema\StringSchema;
use DigitalMarketingFramework\Core\DataProcessor\DataProcessor;
use DigitalMarketingFramework\Distributor\Request\Route\RequestRoute;

class SalesforceCaseRoute extends RequestRoute
{
    public static function getSchema(): SchemaInterface
    {
        /** @var ContainerSchema $schema */
        $schema = parent::getSchema();

        /** @var StringSchema $urlSchema */
        $urlSchema = $schema->getProperty(static::KEY_URL)->getSchema();
        $urlSchema->setDefaultValue('https://{XYZ}.my.salesforce.com/servlet/servlet.WebToCase?encoding=UTF-8');

        return $schema;
    }

    protected static function getDefaultFields(): array
    {
        return [
            'orgid' => DataProcessor::valueSchemaDefaultValueConstant(''),
            'retURL' => DataProcessor::valueSchemaDefaultValueConstant('#'),

            'debug' => DataProcessor::valueSchemaDefaultValueNull(),
            'debugEmail' => DataProcessor::valueSchemaDefaultValueNull(),

            'recordType' => DataProcessor::valueSchemaDefaultValueField('record_type'),

            'name' => DataProcessor::valueSchemaDefaultValueField('name'),
            'email' => DataProcessor::valueSchemaDefaultValueField('email'),
            'phone' => DataProcessor::valueSchemaDefaultValueField('phone'),
            'company' => DataProcessor::valueSchemaDefaultValueField('company'),

            'subject' => DataProcessor::valueSchemaDefaultValueField('subject'),
            'type' => DataProcessor::valueSchemaDefaultValueField('type'),
            'status' => DataProcessor::valueSchemaDefaultValueField('status'),
            'reason' => DataProcessor::valueSchemaDefaultValueField('reason'),
            'priority' => DataProcessor::valueSchemaDefaultValueField('priority'),
            'currency' => DataProcessor::valueSchemaDefaultValueField('currency'),

            'description' => DataProcessor::valueSchemaDefaultValueFieldCollector(),
        ];
    }
}
