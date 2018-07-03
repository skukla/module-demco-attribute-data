<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ZT\DemcoAttributeData\Setup;

use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{
    /**
     * Setup class for product attributes
     *
     * @var \ZT\DemcoAttributeData\Model\Attribute
     */
    protected $attributeSetup;

    /**
     * @param \Kukla\CustomAttributeSampleData\Model\Attribute $attributeSetup
     */


    public function __construct(
        \ZT\DemcoAttributeData\Model\Attribute $attributeSetup,
        \Magento\Framework\App\State $state,
        \Magento\Indexer\Model\Processor $index
    ) {
        $this->attributeSetup = $attributeSetup;
        $this->index = $index;
        try{
            $state->setAreaCode('adminhtml');
        }
        catch(\Magento\Framework\Exception\LocalizedException $e){
            // left empty
        }
    }

    /**
     * {@inheritdoc}
     */
    public function install()
    {
        // Add attributes
        $this->attributeSetup->install(['ZT_DemcoAttributeData::fixtures/attributes.csv']);

        // Reindex
        $this->index->reindexAll();

    }
}
