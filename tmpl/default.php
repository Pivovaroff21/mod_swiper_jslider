<div class="slider <?php echo $moduleclass_sfx ? $moduleclass_sfx : '';?>">


<?php if($params->get('useWrapper')== 1) :?> 
  <div class="wrapper">
<?php endif; ?>
  
  <?php if ($params->get('showCaption') == 1): ?>
    <div class="slider-caption">
      <h3 ><?php echo $params->get('caption-title');?></h3>
      <p ><?php echo $params->get('caption-text');?></p>
    </div>
  <?php endif; ?>


  <swiper-container
      id="slider-<?php echo $module->id;?>"
      init="false"
      space-between = '20'
      speed="<?php echo $params->get('slideSpeed'); ?>"
      pagination="<?php echo $params->get('pagination'); ?>"
      scrollbar="<?php echo $params->get('scrollbar'); ?>"
      direction="<?php echo $params->get('direction') ? 'vertical' : 'horizontal'; ?>"
      loop="<?php echo $params->get('loop'); ?>"  
      autoHeight= "false",   
      effect="<?php echo $params->get('sliderEffect'); ?>"
      slides-per-view="<?php echo $params->get('slidesPerView'); ?>"
  >
      <!-- Slides -->
      <!-- articles layout -->

      <?php if($params->get('sliderContentType') === '1'):?>
        <?php require JModuleHelper::getLayoutPath('mod_j5_swiper', 'default_article'); ?>
      <?php elseif($params->get('sliderContentType') === '0'):?>
        <?php require JModuleHelper::getLayoutPath('mod_j5_swiper', 'default_custom'); ?>
      <?php else:?>
        <?php require JModuleHelper::getLayoutPath('mod_j5_swiper', 'default_testimonials'); ?>
      <?php endif;?>

      <!-- Custom Navigation Buttons -->
  </swiper-container>

  <?php if($params->get('navigation')):?>
    <div class="custom-button-prev">
      <svg class="icon-svg"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
      </svg>
    </div>
    <div class="custom-button-next">
      <svg class="icon-svg"  fill="currentColor" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
        <path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z"/>
      </svg>
    </div>
  <?php endif;?>

  <?php if($params->get('useWrapper')):?> 
  </div>
  <?php endif; ?>
</div>

<script>

// Function to initialize each swiper
function initializeSwiper(swiperEl, index) {
  const slidesPerView = <?php echo (int)($params->get('slidesPerView')); ?>;

  
  const swiperParams = {
    navigation: <?php echo $params->get('navigation') ? json_encode([
      'nextEl' => ".custom-button-next", 
      'prevEl' => ".custom-button-prev",
    ]) : 'false'; ?>,

    autoplay: <?php echo $params->get('autoplay') ? json_encode([
      'delay' => (int)($params->get('autoplayDelay')),
      'disableOnInteraction' => false,
    ]) : 'false'; ?>,

    breakpoints: slidesPerView > 1 ? {

        0:{
          slidesPerView: 1, 
        },
        768: {
          slidesPerView: 2, 
        },
        
        1020: {
          slidesPerView: slidesPerView, 
        },
    } : undefined,

    on: {
      init() {
      },
    },
  };
  Object.assign(swiperEl, swiperParams);
  swiperEl.initialize();

}

document.addEventListener("DOMContentLoaded", () => {
  customElements.whenDefined('swiper-container').then(() => {
    const swiperEl = document.getElementById('slider-<?php echo $module->id; ?>');
    if (swiperEl) {
      initializeSwiper(swiperEl);
    }
  });
});




</script>



