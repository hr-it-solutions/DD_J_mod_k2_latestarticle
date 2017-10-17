<?php
/**
 * @package    DD_Mod_K2_LatestArticle
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_dd_k2_latestarticle/dd_k2_latestarticle.css', array('version' => 'auto', 'relative' => true));

$articles = new Mod_K2_LatestArticle_Helper;
$items = $articles->getLatestArticles();

?>
<div class="dd_mod_k2_latestarticle">
	<?php if ($params->get('associated_article_mode')): ?>
        <div class="row-fluid">
            <div class="span12">
                <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&layout=category&task=category&id=' . $items->catid); ?>">
					<?php echo JText::_('MOD_DD_K2_LATESTARTICLE_ASSOCIATED_ACTIVE_MODE_BACKTOKATEGORY'); ?>
                </a>
            </div>
        </div>
	<?php endif; ?>
    <div class="row-fluid">
		<?php foreach ($items as $item): ?>
            <div class="span4">
                <a href="<?php echo JRoute::_('index.php?option=com_k2&view=item&layout=item&id=' . $item->id); ?>">
                    <img alt="<?php echo $item->title; ?>"
                         src="<?php echo "media/k2/items/cache/" . md5("Image" . $item->id) . "_L.jpg"; ?>"
                </a>
                <a href="<?php echo JRoute::_('index.php?option=com_k2&view=item&layout=item&id=' . $item->id); ?>">
                    <h5><?php echo $item->title; ?></h5>
                </a>
            </div>
		<?php endforeach; ?>
    </div>
</div>
