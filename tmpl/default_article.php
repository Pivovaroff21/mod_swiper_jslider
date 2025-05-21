<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\Component\Content\Site\Helper\RouteHelper;




?>


<?php if (!empty($contentArr)): ?>
    <?php foreach ($contentArr as $item): ?>
        <?php 
            $images = json_decode($item->images);
    
            if($images->image_fulltext){
                $src = $images->image_fulltext;
            }

            if(!$src){
                $src = '/modules/mod_j5_swiper/assets/image-placeholder.jpg';
            }
        ?>
        <swiper-slide >
            <div class="slide-article-content article-item">
                <div class="article-item__img-wrap">
                    <a class="article-item__image-link <?php echo (isset($item->active) && !empty($item->active)) ? $item->active :''; ?>" href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid); ?>">    
                        <img src="<?php echo $src?>" alt="<?php echo $item->title; ?>"/>
                    </a>
                </div>
                <div class="article-item__text">
                    <h4 class="article-item__title">
                        <a class="<?php echo (isset($item->active) && !empty($item->active)) ? $item->active :''; ?>" href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid);  ?>">
                            <?php echo $item->title; ?>
                        </a> 
                    </h4>
                    
  
                </div>
            </div>
        </swiper-slide>
    <?php endforeach; ?>
<?php endif; ?>


