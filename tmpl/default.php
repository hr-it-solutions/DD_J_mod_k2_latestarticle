<?php
/**
 * @package    DD_Mod_K2_LatestArticle
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::_('stylesheet', 'mod_dd_k2_latestarticle/k2_latestarticle.css', array('version' => 'auto', 'relative' => true));

$articles = new Mod_K2_LatestArticle_Helper;

?>
<div class="dd_mod_k2_latestarticle">
    <?php if ($params->get('associated_article_mode')): ?>
    <div class="row-fluid">
        <div class="span12">
            <a href="<?php JRoute::_('index.php?option=com_k2&view=itemlist&layout=category&task=category&id=3'); ?>">
                <?php echo JText::_('MOD_DD_K2_LATESTARTICLE_ASSOCIATED_ACTIVE_MODE_BACKTOKATEGORY'); ?>
            </a>
        </div>
    </div>
	<?php endif; ?>
    <div class="row-fluid">
        <?php foreach ($articles as $article): ?>

            <pre><?php print_r($article->extra_fields) ?></pre>

        <div class="span4">
            <img src="">
            <h5><?php echo $article->title; ?></h5>
        </div>
	    <?php endforeach; ?>
    </div>
</div>
