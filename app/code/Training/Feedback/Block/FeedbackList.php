<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 10.12.18
 * Time: 10:36
 */

namespace Training\Feedback\Block;


use Magento\Framework\View\Element\Template;

class FeedbackList extends Template
{

    const PAGE_SIZE = 3;

    private $collectionFactory;

    private $collection;

    private $timezone;

    private $request;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory,
        \Magento\Framework\Stdlib\DateTime\Timezone $timezone,
        \Magento\Framework\App\RequestInterface $request,
        array $data = array()
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
        $this->timezone = $timezone;
        $this->request = $request;
    }
    public function getFeedbackCollection()
    {
        if (!$this->collection) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToFilter('is_active', 1);
            $this->collection->setOrder('creation_time', 'DESC');
            $this->collection->setPageSize($this->getLimit());
            $this->collection->setCurPage($this->request->getParam('p',1));
        }
        return $this->collection;
    }
    public function getPagerHtml()
    {
        $pagerBlock = $this->getChildBlock('feedback_list_pager');
        if ($pagerBlock instanceof \Magento\Framework\DataObject) {
            /* @var $pagerBlock \Magento\Theme\Block\Html\Pager */
            $pagerBlock
                ->setUseContainer(false)
                ->setShowPerPage(false)
                ->setShowAmounts(false)
                ->setLimit($this->getLimit())
                ->setCollection($this->getFeedbackCollection());
            return $pagerBlock->toHtml();
        }
        return '';
    }
    public function getLimit()
    {
        return static::PAGE_SIZE;
    }
    public function getAddFeedbackUrl()
    {
        return $this->getUrl('training_feedback/index/form');
    }
    public function getFeedbackDate($feedback)
    {
        return $this->timezone->formatDateTime($feedback->getCreationTime());
    }

}