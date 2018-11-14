<?php

namespace Training\Test\Controller\Product;

class View extends \Magento\Catalog\Controller\Product\View
{
    /**
     * @var \Magento\Catalog\Helper\Product\View
     */
    protected $viewHelper;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * View constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Catalog\Helper\Product\View $viewHelper
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Helper\Product\View $viewHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession

    ) {
        $this->customerSession      = $customerSession;
        $this->viewHelper           = $viewHelper;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory    = $resultPageFactory;
        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory);
    }
    public function execute()
    {
        if ($this->customerSession->isLoggedIn())
        {
            return parent::execute();
        }

        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('customer/account/login');
    }
}