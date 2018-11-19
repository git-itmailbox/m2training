<?php

namespace Training\Test\Controller\Block;

use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    private $layoutFactory;

    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        RawFactory $resultRawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        /*  @var  $resultRaw Raw */
        $resultRaw = $this->resultRawFactory->create();

        $layout = $this->layoutFactory->create();
        $block  = $layout->createBlock('Training\Test\Block\Test');
        $resultRaw->setContents($block->toHtml());
        return $resultRaw;
    }

}
