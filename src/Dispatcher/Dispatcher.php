<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 *
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Dreamview\Module\SwiperSlider\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;

class Dispatcher implements DispatcherInterface, HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;
    
    protected $module;
    
    protected $app;

    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app = $app;
    }
    
    public function dispatch()
    {



        $language = $this->app->getLanguage();

        $language->load('mod_swiper_slider', JPATH_BASE . '/modules/mod_swiper_slider');
      
        $helper = $this->getHelperFactory()->getHelper('SwiperSliderHelper');
        
        $params = new Registry($this->module->params);



        require ModuleHelper::getLayoutPath('mod_swiper_slider', $this->module->layout);


        //OLD      
        // if($params->get('moduleclass_sfx')){
        //   $moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
          
        // }else{
          
        //   $moduleclass_sfx = null;
        // }
        // if($params->get('sliderContentType') == 0){
        //   $contentArr = mod_j5_swiperHelper::getContent($params);
        // }else if($params->get('sliderContentType') == 1){
        //   $contentArr = mod_j5_swiperHelper::getList($params);
        // }else{
        //   $contentArr = mod_j5_swiperHelper::getTestimonials($params);
        // }



        // $doc = JFactory::getDocument();
        // $doc->addStyleSheet(JURI::base(true) . '/modules/mod_j5_swiper/assets/css/swiper-bundle.min.css');
        // $doc->addScript(JURI::base(true) . '/modules/mod_j5_swiper/assets/js/swiper-element-bundle.min.js');
        // $doc->addScript(JURI::base(true) . '/modules/mod_j5_swiper/assets/js/swiper-config.js?'.$module->id);
        // $doc->addStyleSheet(JURI::base(true) . '/modules/mod_j5_swiper/assets/css/swiper-custom.css' );
        // require(JModuleHelper::getLayoutPath('mod_j5_swiper'));
    }
}