<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_popular
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;




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
                    <a class="article-item__image-link <?php echo (isset($item->active) && !empty($item->active)) ? $item->active :''; ?>" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid)); ?>">    
                        <img src="<?php echo $src?>" alt="<?php echo $item->title; ?>"/>
                    </a>
                </div>
                <!-- <div class="article-item__category" >
                    <a href="<?php //echo Route::_('index.php?option=com_content&view=category&layout=blog&id='.$item->catid);?>"><?php echo $item->category_title; ?> </a>
                </div> -->
                <div class="article-item__text">
                    <h4 class="article-item__title">
                        <a class="<?php echo (isset($item->active) && !empty($item->active)) ? $item->active :''; ?>" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid)); ?>">
                            <?php echo $item->title; ?>
                        </a> 
                    </h4>
                    
  
                </div>
            </div>
        </swiper-slide>
    <?php endforeach; ?>
<?php endif; ?>


