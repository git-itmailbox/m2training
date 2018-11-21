<?php

namespace Yuritbox\Showmexml\Plugin\View;

use Psr\Log\LoggerInterface;

class Layout
{
    /*
     * @var LoggerInterface
     */
    private $logger;

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function afterGenerateXml(\Magento\Framework\View\Layout $subject, $result)
    {
        $this->logger->info($result->getUpdate()->asString());
//        echo "<pre>";
//        print_r($result->getUpdate()->asSimplexml());
//        echo "</pre>";
//        exit();
        return $result;
    }
}