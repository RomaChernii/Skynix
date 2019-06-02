<?php
/**
 * Config observer after changed section payment
 *
 * @category Skynix
 * @package  Skynix\PaymentConfigurator
 * @author   Roman Chernii
 */
namespace Skynix\PaymentConfigurator\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Skynix\PaymentConfigurator\Model\ResourceModel\Configurator;

/**
 * ConfigObserver
 *
 * @package Skynix\PaymentConfigurator\Observer
 */
class ConfigObserver implements ObserverInterface
{
    /**
     * Payment config path to api key
     */
    const PAYMENT_CONFIG_PATH = 'payment/skynix/api_key';

    /**
     * Configurator resource model
     *
     * @var Configurator
     */
    protected $configurator;

    /**
     * Scope config interface
     *
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * ConfigObserver constructor
     *
     * @param Configurator         $configurator
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Configurator $configurator,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->configurator = $configurator;
        $this->scopeConfig = $scopeConfig;
    }


    /**
     * Execute after config changed section payment
     * Save skynix api key to skynix_payment_configurator table
     * event: admin_system_config_changed_section_payment
     *
     * @param EventObserver $observer
     *
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        $data = $this->scopeConfig->getValue(static::PAYMENT_CONFIG_PATH);
        $this->configurator->insertApiKey($data);
    }
}
