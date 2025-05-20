<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module as ModuleServiceProvider;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory as ModuleDispatcherFactoryServiceProvider;
use Joomla\CMS\Extension\Service\Provider\HelperFactory as HelperFactoryServiceProvider;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface {

    public function register(Container $container): void
    {
        $container->registerServiceProvider(new ModuleDispatcherFactoryServiceProvider('\\Dreamview\\Module\\SwiperSlider'));
        $container->registerServiceProvider(new HelperFactoryServiceProvider('\\Dreamview\\Module\\SwiperSlider\\Site\\Helper'));
        $container->registerServiceProvider(new ModuleServiceProvider());
    }
};