<?php
/**
 * Skynix PaymentConfigurator configurator resource model
 *
 * @category Skynix
 * @package  Skynix\PaymentConfigurator
 * @author   Roman Chernii
 */
namespace Skynix\PaymentConfigurator\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Configurator
 *
 * @package Skynix\PaymentConfigurator\Model\ResourceModel
 */
class Configurator extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('skynix_payment_configurator', 'id');
    }

    /**
     * Insert api key
     *
     * @param array $apiKey
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @return  void
     */
    public function insertApiKey($apiKey)
    {
        $this->getConnection()
             ->insert(
                 $this->getMainTable(),
                 ['api_key' => $apiKey]
             );
    }
}
