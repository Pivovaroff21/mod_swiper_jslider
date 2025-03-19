
<?php if (!empty($contentArr)): ?>
    <?php foreach ($contentArr as $item): ?>
        <?php if ($item->image): ?>
            <swiper-slide style="min-height:400px;background-image:url(<?php echo $item->image; ?>);">
                <div class="slide-content">
                    <?php echo $item->content; ?>
                </div>
                
                <?php if($params->get('slidesPerView') == 1):?>
                    <div class="slider-footer-img">
                        <img src="/templates/travelblog/assets/images/slider-footer.png"/>
                    </div>
                <?php endif;?>
            </swiper-slide>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
