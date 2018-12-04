<?php

namespace Training\QuantityChecker\ViewModel;

class QuantityChecker implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $registry;

    public function __construct(\Magento\Framework\Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getCurProductId()
    {
        return $this->getCurrentProduct()->getId();
    }


}
