<?php
/**
 * Skynix PaymentConfigurator install schema
 *
 * @category Skynix
 * @package  Skynix\PaymentConfigurator
 * @author   Roman Chernii
 */
namespace Skynix\PaymentConfigurator\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Skynix\PaymentConfigurator\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    const SKYNIX_API_KEY = 'UI209KWPOLANKD71P0OQL8362810DW8P';

    /**
     * Install tabel skynix_payment_configurator
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = $installer->getTable('skynix_payment_configurator');
        $table = $installer->getConnection()->newTable(
            $tableName
        )->addColumn(
            'id',
            Table::TYPE_SMALLINT,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Payment configurator ID'
        )->addColumn(
            'api_key',
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Payment configurator api key'
        )->setComment(
            'Skynix payment configurator'
        );

        $installer->getConnection()->createTable($table);

        // Insert api key value to skynix_payment_configurator table
        if ($installer->getConnection()->isTableExists($tableName)) {
            $installer->getConnection()
                 ->insert(
                     $tableName,
                     ['api_key' => static::SKYNIX_API_KEY]
                 );
        }

        $installer->endSetup();
    }
}
