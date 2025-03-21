<?php

#@license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

/* FANCY PANTS ACCORDION */

defined('_JEXEC') or die;
require_once(dirname(__FILE__).'/helper.php');

if($params->get('moduleclass_sfx')){
  $moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
  
}else{
  
  $moduleclass_sfx = null;
}
if($params->get('sliderContentType') == 0){
  $contentArr = mod_j5_swiperHelper::getContent($params);
}else if($params->get('sliderContentType') == 1){
  $contentArr = mod_j5_swiperHelper::getList($params);
}else{
  $contentArr = mod_j5_swiperHelper::getTestimonials($params);
}



$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_j5_swiper/assets/css/swiper-bundle.min.css');
$doc->addScript(JURI::base(true) . '/modules/mod_j5_swiper/assets/js/swiper-element-bundle.min.js');
$doc->addScript(JURI::base(true) . '/modules/mod_j5_swiper/assets/js/swiper-config.js?'.$module->id);
$doc->addStyleSheet(JURI::base(true) . '/modules/mod_j5_swiper/assets/css/swiper-custom.css' );
require(JModuleHelper::getLayoutPath('mod_j5_swiper'));
