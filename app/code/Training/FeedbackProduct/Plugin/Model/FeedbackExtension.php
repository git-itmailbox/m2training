<?php

namespace Training\FeedbackProduct\Plugin\Model;

use Training\Feedback\Api\Data\FeedbackInterface;

class FeedbackExtension
{

    private $extensionAttributesFactory;

    public function __construct(
        \Training\Feedback\Api\Data\FeedbackExtensionInterfaceFactory $extensionAttributesFactory
    ) {
        $this->extensionAttributesFactory = $extensionAttributesFactory;
    }

    public function afterGetExtensionAttributes(FeedbackInterface $subject, $result)
    {
        if (!is_null($result))
        {
            return $result;
        }

        /** @var \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes */
        $extensionAttributes = $this->extensionAttributesFactory->create();
        $subject->setExtensionAttributes($extensionAttributes);

        return $extensionAttributes;
    }
}