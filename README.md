product-slider

===============

Installation

1) Copy and Paste the files in your project root directory.

2) Remove cache after installtion.

3) Make sure the media directory has read and write permissions

===============

Folder Structure

1) app/code/community/Misc/
2) app/design/frontend/default/base/template/productslider
3) app/design/frontend/default/base/layout/productslider
4) js/productslider
5) skin/frontend/base/default/css/productslider.css
6) media/productslider/images


================

How To Use

================

Copy the following code to your static page/block and replace the category_id.

{{block type="productslider/horizontal_horizontal" template="productslider/horizontal/view.phtml" category_id="20"}}
