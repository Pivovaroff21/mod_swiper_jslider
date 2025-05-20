<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_swiper_slider
 * @copyright   (C) 2025 Bohdan Pyvovarov All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Dreamview\Module\SwiperSlider\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Access\Access;
use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Cache\CacheControllerFactoryInterface;
use Joomla\CMS\Cache\Controller\OutputController;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;
use Joomla\Component\Content\Site\Model\ArticlesModel;
use Joomla\Registry\Registry;
class SwiperSliderHelper {
    
    public static function getContent(&$params) {
        $contentArr = array();
        $i = 1;
        while (true) {
            $image = $params->get("image" . $i);
            $htmlContent = $params->get("content" . $i);
            $linkText = $params->get("link_text" . $i);
            if($image == null && $htmlContent == null && $linkText == null ){
                break;
            }
            $obj = new \StdClass();
            $obj->link_text = $linkText;
            $obj->content = $htmlContent;
            $obj->image = $image;
            $contentArr[] = $obj;
            $i++;
        }
        return $contentArr;
    }


public static function getTestimonials(&$params) {
    $app = Factory::getApplication();
    $db = Factory::getDbo();

    // Get current page parameters
    $component = $app->input->get('option', '', 'STRING'); 
    $view = $app->input->get('view', '', 'STRING'); 
    $id = $app->input->getInt('id', 0); 

    // Generate possible relation values
    $relationExact = "$component:$view:$id";
    $relationNoID = "$component:$view:";
    $relationOnlyOption = "$component:";

    // Build the query
    $query = $db->getQuery(true)
        ->select('*')
        ->from($db->quoteName('#__testimonials'))
        ->where("relation = " . $db->quote($relationExact) . " 
            OR relation = " . $db->quote($relationNoID) . "
            OR relation = " . $db->quote($relationOnlyOption) . "
            OR relation IS NULL 
            OR relation = ''")
        ->order('id DESC');

    $db->setQuery($query);
    return $db->loadObjectList();
}


    public function getArticles(Registry $moduleParams, SiteApplication $app)
    {

        /** @var OutputController $cache */
        $cache = Factory::getContainer()->get(CacheControllerFactoryInterface::class)
            ->createCacheController('output', ['defaultgroup' => 'mod_articles_popular']);
        
       
            $mvcContentFactory = $app->bootComponent('com_content')->getMVCFactory();

            /** @var ArticlesModel $articlesModel */
            $articlesModel = $mvcContentFactory->createModel('Articles', 'Site', ['ignore_request' => true]);

            // Set application parameters in model
            $appParams = $app->getParams();
            $articlesModel->setState('params', $appParams);

            $articlesModel->setState('list.start', 0);
            $articlesModel->setState('filter.published', ContentComponent::CONDITION_PUBLISHED);

            // Set the filters based on the module params
            $articlesModel->setState('list.limit', (int) $moduleParams->get('articlesCount', 5));
            // $articlesModel->setState('filter.featured', $moduleParams->get('show_front', 1) == 1 ? 'show' : 'hide');

            // This module does not use tags data
            $articlesModel->setState('load_tags', false);

            // Access filter
            $access = !ComponentHelper::getParams('com_content')->get('show_noauth');
            $articlesModel->setState('filter.access', $access);



           
            // Date filter
            $date_filtering = $moduleParams->get('date_filtering', 'off');

            if ($date_filtering !== 'off') {
                $articlesModel->setState('filter.date_filtering', $date_filtering);
                $articlesModel->setState('filter.date_field', $moduleParams->get('date_field', 'a.created'));
                $articlesModel->setState('filter.start_date_range', $moduleParams->get('start_date_range', '1000-01-01 00:00:00'));
                $articlesModel->setState('filter.end_date_range', $moduleParams->get('end_date_range', '9999-12-31 23:59:59'));
                $articlesModel->setState('filter.relative_date', $moduleParams->get('relative_date', 30));
            }
            $articlesModel->setState('filter.language', $app->getLanguageFilter());


            

            // Category filter
            $catid = $moduleParams->get('catid', []);
            if(empty($catid)){ 
                $catid[] = (int)$app->input->get('catid');
            }
            $articlesModel->setState('filter.category_id', $catid);

            if ($moduleParams->get('articleContentType') == 1) {
                $currentId = (int) $app->input->get('id', 0);
                $articlesModel->setState('list.limit', 8);
                
                $articlesModel->setState('list.ordering', 'a.id');
                $articlesModel->setState('list.direction', 'ASC');

                $db = Factory::getContainer()->get('DatabaseDriver');
                $query = $db->getQuery(true)
                    ->select('id')
                    ->from('#__content')
                    ->where('id > ' . (int) $currentId)
                    ->where($db->quoteName('state').'='. $db->quote(1))
                    ->where('FIND_IN_SET(' . $db->quote(1) . ', ' . $db->quoteName('catid') . ')')
                    ->order('id ASC')
                    ->setLimit(8);

                $db->setQuery($query);
                $ids = $db->loadColumn();

                if (!empty($ids)) {
                    $articlesModel->setState('filter.article_id', $ids);
                }
                
            }

            if($moduleParams->get('articleContentType') == 0){
                $articlesModel->setState('list.ordering', 'a.hits');
                $articlesModel->setState('list.direction', 'DESC');
            }else{
                $articlesModel->setState('list.ordering', 'a.id');
                $articlesModel->setState('list.direction', 'ASC'); 
            }

            

            
            
            // Prepare the module output
            $items      = [];
            $itemParams = new \stdClass();

            $itemParams->authorised = Access::getAuthorisedViewLevels($app->getIdentity()->get('id'));
            $itemParams->access     = $access;

            foreach ($articlesModel->getItems() as $item) {
                $items[] = $this->prepareItem($item, $itemParams);
            }
            
            return $items;
    }

    /**
     * Prepare the article before render.
     *
     * @param   object     $item   The article to prepare
     * @param   \stdClass  $params  The model item
     *
     * @return  object
     *
     * @since   4.3.0
     */
    private function prepareItem($item, $params): object
    {
        $item->slug = $item->id . ':' . $item->alias;

        if ($params->access || \in_array($item->access, $params->authorised)) {
            // We know that user has the privilege to view the article
            $item->link = Route::_(RouteHelper::getArticleRoute($item->slug, $item->catid, $item->language));
        } else {
            $item->link = Route::_('index.php?option=com_users&view=login');
        }

        return $item;
    }

    /**
     * Get a list of popular articles from the articles model
     *
     * @param   \Joomla\Registry\Registry  &$params  object holding the models parameters
     *
     * @return  mixed
     *
     * @since  4.3.0
     *
     * @deprecated 4.3 will be removed in 6.0
     */
    public static function getList(&$params)
    {
        
        return (new self())->getArticles($params, Factory::getApplication());
    }



}
