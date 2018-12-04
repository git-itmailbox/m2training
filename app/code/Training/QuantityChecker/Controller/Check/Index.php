<?php

namespace Training\QuantityChecker\Controller\Check;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $registry;

    protected $request;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product
     */
    protected $productResource;


    protected $stockState;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonResultFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
     */
    public function __construct(
        Context $context,
//        \Magento\Catalog\Model\ResourceModel\Product $productResource,
//        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\CatalogInventory\Api\StockStateInterface $stockState,
        \Magento\Framework\Controller\Result\JsonFactory $jsonResultFactory
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->request = $context->getRequest();
        $this->stockState = $stockState;
//        $this->productFactory = $productFactory;
//        $this->productResource = $productResource;
        parent::__construct($context);
    }
    public function execute()
    {
        $productId = (int) $this->request->getParam('product_id');
        $result = $this->jsonResultFactory->create();
        $qty = $this->stockState->getStockQty($productId);
        $result->setData([ 'id'=> $productId, 'qty'=> $qty]);
        return $result;
    }
}