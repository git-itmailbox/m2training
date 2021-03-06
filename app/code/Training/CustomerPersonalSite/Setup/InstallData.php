<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training\CustomerPersonalSite\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $attributeName = 'personal_site';
        $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, $attributeName, [
            'type' => 'varchar',
            'label' => 'Personal Site URL',
            'input' => 'text',
// add url validation rule twice in different format for utilizing by different forms
            'validate_rules' => '{"max_text_length":250,"input_validation":"url","validate-url":true}',
            'required' => false,
            'system' => false,
            'user_defined' => true,
            'group' => 'General',
            'unique' => true,
            'sort_order' => 300,
            'position' => 300,
        ]);
        $attributeId = $customerSetup->getAttributeId(\Magento\Customer\Model\Customer::ENTITY,
            $attributeName);
        $setup->getConnection()
            ->insertMultiple($setup->getTable('customer_form_attribute'), [
                ['form_code' => 'adminhtml_customer', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_create', 'attribute_id' => $attributeId],
                ['form_code' => 'customer_account_edit', 'attribute_id' => $attributeId]
            ]);
    }
}
