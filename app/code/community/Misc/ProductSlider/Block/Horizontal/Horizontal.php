<?php
class Misc_ProductSlider_Block_Horizontal_Horizontal extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }

    public function getProductImages($categoryId)
    {
	$proArray=Mage::Helper('productslider')->getProducts($categoryId);

	$images=Mage::Helper('productslider')->getProductImages($proArray);

	return $images;
    }
 
}
