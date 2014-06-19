<?php

class Misc_ProductSlider_Helper_Data extends Mage_Core_Helper_Abstract {

	protected $_prod_id;
	
	protected $_folder_name='productslider';



public function resizeImage($width,$height='null',$imageUrl){

				
	if($height=='null'):  	/*for square images, setting equal height and width*/
	  	$height=$width;
	else:
	  	$height=$height;
	endif;
		
	$folder_path=Mage::getBaseDir('media').DS.$this->_folder_name.DS.$this->_prod_id.'x'.$width.'x'.$height;
	$imageName = substr(strrchr($imageUrl,"/"),1);

	$imageResized=$folder_path.DS.$imageName;

	if(!is_dir($folder_path)||!file_exists($imageResized)):

		if(!is_dir($folder_path)):
		$this->createdirectory($folder_path);
		endif;

	 $dirImg = Mage::getBaseDir().str_replace("/",DS,strstr($imageUrl,'/media'));

		if (!file_exists($imageResized)&&file_exists($dirImg)) :
			$imageObj = new Varien_Image($dirImg);
			$imageObj->constrainOnly(TRUE);
			$imageObj->keepAspectRatio(TRUE);
			$imageObj->keepFrame(FALSE);
			$imageObj->resize($width, $height);
	   	        $imageObj->save($imageResized);
		endif;
	$imageUrl=Mage::getBaseUrl('media').$this->_folder_name.DS.$this->_prod_id.'x'.$width.'x'.$height.DS.$imageName;
	else:
	$imageUrl=Mage::getBaseUrl('media').$this->_folder_name.DS.$this->_prod_id.'x'.$width.'x'.$height.DS.$imageName;
	endif;
	return $imageUrl;
}
	
public function createdirectory($folder_path){

	$dir= new Varien_Io_File;
	$dir->mkdir($folder_path);
		
}

public function getproducts($categoryId){
	$category = Mage::getModel('catalog/category')->load($categoryId);
	$products = Mage::getModel('catalog/product')
	    ->getCollection()
	    ->addCategoryFilter($category)
	    ->load();
	return $products;
}
 
public function getProductImages($products){

Mage::log($products->getData(),3,"products_data.log");
$images="<ul id='carousel_ul'>";	
foreach($products as $prod){

$this->_prod_id=$prod->getEntityId();
$product=Mage::getModel("catalog/product")->load($prod->getEntityId());

$productMediaConfig = Mage::getModel('catalog/product_media_config');
 
$produrl=$this->getCatProdUrl($product);

//$baseImageUrl = $productMediaConfig->getMediaUrl($product->getImage());
//$smallImageUrl = $productMediaConfig->getMediaUrl($product->getSmallImage());
$thumbnailUrl = $productMediaConfig->getMediaUrl($product->getThumbnail());

$image_url=$this->resizeImage("100","100",$thumbnailUrl);

$images.= "<li><a href='".$produrl."'><img src='".$image_url."' alt='".$product->getName()."' /></a></li>";
}
$images=$images.'<ul/>';
return $images;
}

public function getCatProdUrl($product){

    $allCategoryIds     = $product->getCategoryIds();
    $lastCategoryId     = end($allCategoryIds);
    $lastCategory       = Mage::getModel('catalog/category')->load($lastCategoryId);
    $lastCategoryUrl    = $lastCategory->getUrl();
    $fullProductUrl     = str_replace(Mage::getStoreConfig('catalog/seo/category_url_suffix'), '/', $lastCategoryUrl) . basename( $product->getUrlKey() ) . Mage::getStoreConfig('catalog/seo/product_url_suffix');
    return $fullProductUrl;

}

}
