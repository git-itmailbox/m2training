<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 22.11.18
 * Time: 15:23
 */

namespace Yuritbox\Currency\Controller\Currency;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{

    private $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // TODO: Implement execute() method.
        $resultPage = $this->resultPageFactory->create();

//        $block = $resultPage->getLayout()->createBlock('Magento\Framework\View\Element\Template');
//        $html = $block->setTemplate('Yuritbox_Currency::play_with_currency.phtml')->toHtml();
//
//        $resultPage->setContents($html);
        return $resultPage;
    }
}