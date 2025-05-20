
<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 *
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_swiper_slider');
$wa->useStyle('mod_swiper_slider.swiper-bundle')
    ->useStyle('mod_swiper_slider.swiper-custom')
    ->useScript('mod_swiper_slider.swiper-config');


?>
<div class="slider <?php echo $moduleclass_sfx ? $moduleclass_sfx : '';?>">


<?php if($params->get('useWrapper')== 1) :?> 
  <div class="wrapper">
<?php endif; ?>
  
  <?php if ($params->get('showCaption') == 1): ?>
    <div class="slider-caption">
      <?php if($params->get('caption-title')):?>
        <h3 ><?php echo $params->get('caption-title');?></h3>
      <?php endif; ?>
      <?php if($params->get('caption-text')):?>
        <p ><?php echo $params->get('caption-text');?></p>
      <?php endif; ?>
    </div>
  <?php endif; ?>


  <swiper-container
      id="slider-<?php echo $module->id;?>"
      init="false"
      space-between = '20'
      autoHeight= "false"
      speed="<?php echo $params->get('slideSpeed'); ?>"
      pagination="<?php echo $params->get('pagination'); ?>"
      scrollbar="<?php echo $params->get('scrollbar'); ?>"
      direction="<?php echo $params->get('direction') ? 'vertical' : 'horizontal'; ?>"
      loop="<?php echo $params->get('loop'); ?>"  
      effect="<?php echo $params->get('sliderEffect'); ?>"
      slides-per-view="<?php echo $params->get('slidesPerView'); ?>"
      data-id ="<?php echo $module->id;?>"
      data-navigation="<?php echo $params->get('navigation') ? 'true' : 'false'; ?>"
      data-autoplay="<?php echo $params->get('autoplay') ? 'true' : 'false'; ?>"
      data-autoplay-delay="<?php echo (int)($params->get('autoplayDelay')); ?>"
      data-slide-per-group="<?php echo (int)($params->get('slidePerGroup')); ?>">
      <!-- Slides -->
      <!-- articles layout -->
      <?php


        if($params->get('sliderContentType') === '1'){
          
          require ModuleHelper::getLayoutPath('mod_swiper_slider', $params->get('layout', 'default') . '_article'); 
        }
      
        elseif($params->get('sliderContentType') === '0'){
          require ModuleHelper::getLayoutPath('mod_swiper_slider', $params->get('layout', 'default') . '_custom');
         
        }
          
        else{
          require ModuleHelper::getLayoutPath('mod_swiper_slider', $params->get('layout', 'default') . '_testimonials');
      

        }
      ?>


      <!-- Custom Navigation Buttons -->
  </swiper-container>

<?php if($params->get('navigation')):?>
    <div class="custom-button-prev custom-button-prev-<?php echo $module->id;?>">
      <svg class="icon-svg" viewBox="0 0 30 24" width="30" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
      </svg>
    </div>
    <div class="custom-button-next custom-button-next-<?php echo $module->id;?>">
      <svg class="icon-svg" viewBox="0 0 30 24" width="30" height="24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
      </svg>
    </div>
<?php endif;?>


  <?php if($params->get('useWrapper')):?> 
  </div>
  <?php endif; ?>
</div>



