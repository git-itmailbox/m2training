<?php

namespace Training\Feedback\Controller\Index;

use Magento\Framework\App\Action\Action;
use Training\Feedback\Api\Data\FeedbackInterface;
use Training\Feedback\Model\Feedback;


class Test extends Action
{

    private $feedbackFactory;
    private $feedbackRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        // create new item
//        $this->createFeedback();
        // load item by id
//        $this->loadFeedback();
//        // update item
//        $this->updateFeedback();
//        // delete feedback
//        $this->feedbackRepository->deleteById(9);
//        // load multiple items
        $this->loadMultipleFeedbacks();
        exit();
    }

    private function printFeedback($feedback)
    {
        echo $feedback->getId() . ' : '
            . $feedback->getAuthorName()
            . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }

    private function createFeedback()
    {
        $newFeedback = $this->feedbackFactory->create();
        $newFeedback->setAuthorName('some name');
        $newFeedback->setAuthorEmail('test@test.com');
        $newFeedback->setMessage('ghj dsghjfghs sghkfgsdhfkj sdhjfsdf gsfkj');
        $newFeedback->setIsActive(1);
        $this->feedbackRepository->save($newFeedback);
    }

    private function loadFeedback()
    {
        $feedback = $this->feedbackRepository->getById(1);
        $this->printFeedback($feedback);
    }

    private function updateFeedback()
    {
        $feedbackToUpdate = $this->feedbackRepository->getById(1);
        $feedbackToUpdate->setMessage('CUSTOM ' . $feedbackToUpdate->getMessage());
        $feedbackToUpdate->setAuthorName('CUSTOM ' . $feedbackToUpdate->getAuthorName());
        $this->feedbackRepository->save($feedbackToUpdate);

    }

    private function loadMultipleFeedbacks()
    {
        $this->searchCriteriaBuilder
            ->addFilter(FeedbackInterface::IS_ACTIVE, Feedback::STATUS_ACTIVE);
        $sortOrder = $this->sortOrderBuilder
            ->setField(FeedbackInterface::UPDATE_TIME)
            ->setAscendingDirection()
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }
    }
}