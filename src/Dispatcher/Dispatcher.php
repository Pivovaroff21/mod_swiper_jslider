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

        $helper = $this->getHelperFactory()->getHelper('SwiperSliderHelper');
        
        $params = new Registry($this->module->params);

       
        $contentArr = [];

        if($params->get('sliderContentType') == 0){
          $contentArr = $helper->getContent($params);
        }else if($params->get('sliderContentType') == 1){
          $contentArr = $helper->getList($params);
        }else{
          $contentArr = $helper->getTestimonials($params);
        }

        require ModuleHelper::getLayoutPath('mod_swiper_slider', $this->module->layout);



       


    }
}