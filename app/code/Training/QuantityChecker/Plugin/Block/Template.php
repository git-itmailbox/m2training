<?php

namespace Training\QuantityChecker\Plugin\Block;

use Magento\Catalog\Model\Product\Type;

class Template
{

//    protected $registry;

    /**
     * @var \Magento\Catalog\Model\Product
     */
    protected $currentProduct;

    public function __construct(\Magento\Framework\Registry $registry)
    {
//        $this->registry = $registry;
        $this->currentProduct = $registry->registry('current_product');
    }


    public function afterToHtml(\Training\QuantityChecker\Block\CheckQty $subject, $result )
    {
        if ($this->currentProduct->getTypeId() !== Type::TYPE_SIMPLE)
        {
            $result = '';
        }
        return $result;
    }
}