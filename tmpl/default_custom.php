<?php 

/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 *
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

 defined('_JEXEC') or die;

 ?>

<?php if (!empty($contentArr)): ?>
    <?php foreach ($contentArr as $item): ?>
        <?php if ($item->image): ?>
            <swiper-slide style="min-height:400px;background-image:url(<?php echo $item->image; ?>);">
                <div class="slide-content">
                    <?php echo $item->content; ?>
                </div>
                
            </swiper-slide>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
