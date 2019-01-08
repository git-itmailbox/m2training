<?php

namespace Training\FeedbackProduct\Model\ResourceModel;

use Training\FeedbackProduct\Model\FeedbackDataLoader;

class FeedbackProducts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('training_feedback_product', 'row_id');
    }

    //$productIds = $this->feedbackProductsResource->loadProductRelations($feedback->getId());
    //$this->feedbackProductsResource->saveProductRelations($feedback->getId(), $productIds);


    public function loadProductRelations(int $feedbackId)
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from($this->getTable('training_feedback_product'), ['product_id'])
            ->where('feedback_id = ?', $feedbackId);
        return $adapter->fetchCol($select);

    }

    public function saveProductRelations($feedbackId, array $productIds)
    {
        $savedProductIds = $this->loadProductRelations($feedbackId);
        $productIdsToAdd = array_diff($productIds, $savedProductIds);
        $productIdsToDelete = array_diff($savedProductIds, $productIds);
        $dataToAdd = [];
        foreach ($productIdsToAdd as $productId) {
            $dataToAdd[] = ['feedback_id' => $feedbackId, 'product_id' => $productId];
        }
        $this->getConnection()->insertMultiple($this->getTable('training_feedback_product'), $dataToAdd);
        $this->getConnection()->delete(
            $this->getTable('training_feedback_product'),
            ['feedback_id = ?' => $feedbackId, 'product_id IN (?)' => $productIdsToDelete]
        );
        return $this;
    }

//    public function saveProductRelations(int $feedbackId, array $productIds)
//    {
//
//    }

}