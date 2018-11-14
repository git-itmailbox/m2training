<?php

namespace Training\Test\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class Index extends \Magento\Framework\App\Action\Action
{

    private $resultRawFactory;

    public function __construct(Context $context, RawFactory $resultRawFactory)
    {
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents('<h2>simple text</h2>');
        return $resultRaw;
    }
}