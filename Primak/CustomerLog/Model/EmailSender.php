<?php

declare(strict_types=1);

namespace Primak\CustomerLog\Model;

use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\State;
use Primak\CustomerLog\Model\Config;

/**
 * class EmailSender
 */
class EmailSender
{
    /**
     * @var StateInterface
     */
    protected StateInterface $inlineTranslation;

    /**
     * @var Escaper
     */
    protected Escaper $escaper;

    /**
     * @var TransportBuilder
     */
    protected TransportBuilder $transportBuilder;

    /**
     * @var State
     */
    protected State $state;

    /**
     * @var Config
     */
    protected Config $config;

    /**
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param TransportBuilder $transportBuilder
     * @param State $state
     * @param \Primak\CustomerLog\Model\Config $config
     */
    public function __construct(
        StateInterface   $inlineTranslation,
        Escaper          $escaper,
        TransportBuilder $transportBuilder,
        State            $state,
        Config           $config
    )
    {
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->state = $state;
        $this->config = $config;
    }

    /**
     * @param $qty
     * @return void
     */
    public function sendEmail($qty)
    {
        try {
            $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);
        } catch (\Magento\Framework\Exception\LocalizedException $exception) {
        }
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Store Login Statistic'),
                'email' => $this->escaper->escapeHtml($this->config->getStoreEmailAddress()),
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('customer_login_qty')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'qtyCount' => $qty,
                ])
                ->setFromByScope($sender)
                ->addTo($this->config->getEmailForSend())
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
        }
    }
}
