<?php

namespace DigitalMarketingFramework\Distributor\SalesforceCase\Route;

use DigitalMarketingFramework\Core\Model\Data\DataInterface;
use DigitalMarketingFramework\Core\SchemaDocument\FieldDefinition\FieldDefinition;
use DigitalMarketingFramework\Core\SchemaDocument\Schema\ContainerSchema;
use DigitalMarketingFramework\Core\SchemaDocument\Schema\SchemaInterface;
use DigitalMarketingFramework\Core\SchemaDocument\Schema\StringSchema;
use DigitalMarketingFramework\Core\DataProcessor\DataProcessor;
use DigitalMarketingFramework\Distributor\Request\Route\RequestOutboundRoute;

class SalesforceCaseOutboundRoute extends RequestOutboundRoute
{
    public const KEY_ORGID = 'orgid';

    public const DEFAULT_ORGID = '';

    public const KEY_DEBUG_EMAIL = 'debugEmail';

    public const DEFAULT_DEBUG_EMAIL = '';

    public static function getIntegrationName(): string
    {
        return 'salesforce';
    }

    public static function getIntegrationLabel(): ?string
    {
        return 'SalesForce';
    }

    public static function getOutboundRouteListLabel(): ?string
    {
        return null;
    }

    public static function getLabel(): ?string
    {
        return 'Web-To-Case';
    }

    public function buildData(): DataInterface
    {
        $data = parent::buildData();

        $data['orgid'] = $this->getConfig(static::KEY_ORGID);
        $data['retURL'] = '#';

        $debugEmail = $this->getConfig(static::KEY_DEBUG_EMAIL);
        if ($debugEmail !== '') {
            $data['debug'] = '1';
            $data['debugEmail'] = $debugEmail;
        }

        return $data;
    }

    public static function getSchema(): SchemaInterface
    {
        /** @var ContainerSchema $schema */
        $schema = parent::getSchema();

        /** @var StringSchema $urlSchema */
        $urlSchema = $schema->getProperty(static::KEY_URL)->getSchema();
        $urlSchema->setDefaultValue('https://{XYZ}.my.salesforce.com/servlet/servlet.WebToCase?encoding=UTF-8');

        $orgidSchema = new StringSchema(static::DEFAULT_ORGID);
        $schema->addProperty(static::KEY_ORGID, $orgidSchema);

        $debugSchema = new StringSchema(static::DEFAULT_DEBUG_EMAIL);
        $schema->addProperty(static::KEY_DEBUG_EMAIL, $debugSchema);

        return $schema;
    }

    public static function getDefaultFields(): array
    {
        return [
            new FieldDefinition('recordType', type: FieldDefinition::TYPE_STRING, label: 'Record Type', multiValue: false, required: false),

            new FieldDefinition('name', type: FieldDefinition::TYPE_STRING, label: 'Name', multiValue: false, required: false),
            new FieldDefinition('email', type: FieldDefinition::TYPE_STRING, label: 'Email', multiValue: false, required: true),
            new FieldDefinition('phone', type: FieldDefinition::TYPE_STRING, label: 'Phone', multiValue: false, required: false),
            new FieldDefinition('company', type: FieldDefinition::TYPE_STRING, label: 'Company', multiValue: false, required: false),

            new FieldDefinition('subject', type: FieldDefinition::TYPE_STRING, label: 'Subject', multiValue: false, required: false),
            new FieldDefinition('type', type: FieldDefinition::TYPE_STRING, label: 'Type', multiValue: false, required: false),
            new FieldDefinition('status', type: FieldDefinition::TYPE_STRING, label: 'Status', multiValue: false, required: false),
            new FieldDefinition('reason', type: FieldDefinition::TYPE_STRING, label: 'Reason', multiValue: false, required: false),
            new FieldDefinition('priority', type: FieldDefinition::TYPE_STRING, label: 'Priority', multiValue: false, required: false),
            new FieldDefinition('currency', type: FieldDefinition::TYPE_STRING, label: 'Currency', multiValue: false, required: false),

            new FieldDefinition('description', type: FieldDefinition::TYPE_STRING, label: 'Description', multiValue: false, dedicated: FieldDefinition::DEDICATED_COLLECTOR_FIELD, required: false),
        ];
    }
}
