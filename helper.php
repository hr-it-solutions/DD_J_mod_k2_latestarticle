<?php
/**
 * @package    DD_Mod_K2_LatestArticle
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

/**
 * Helper for mod_k2_latestarticle
 *
 * @since  Version 1.0.0.0
 */
class Mod_K2_LatestArticle_Helper
{
	protected $app;

	protected $params;

	/**
	 * getLatestArticles
	 *
	 * @since Version 1.0.0.0
	 *
	 * @return object
	 */
	public function getLatestArticles()
	{
		$module = JModuleHelper::getModule('mod_k2_latestarticle');
		$params = new JRegistry($module->params);

		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		$select = $db->qn(
			array(
				'a.id',
				'a.id',
				'a.introtext',
				'a.extra_fields'
			)
		);

		$query->select($select)
			->from($db->qn('#__k2_items', 'a'));

		if ($params->get('associated_article_mode') === '1')
		{
			$query = $this->associatedArticleModeQuery($query, $db);
		}

		$query->order('a.id DESC LIMIT 0, 3');

		// Set this query using query object
		$db->setQuery($query);

		// Return Object List
		return $db->loadObjectList();
	}

	/**
	 * associatedArticleModeQuery
	 *
	 * @param   object  &$db    JDatabaseObject
	 * @param   object  $query  query
	 *
	 * @since  Version 1.0.0.0
	 *
	 * @return mixed
	 */
	private function associatedArticleModeQuery(&$db, $query)
	{
		if ($this->app->input->getCmd('option') === 'com_k2')
		{
			if ($this->app->input->getCmd('view') === 'item')
			{
				$inputId = (int) $this->app->input->getCmd('id');

				// Create a new query object as thisQuery
				$thisQuery = $db->getQuery(true);

				$thisQuery->select($db->qn('catid'))->from($db->qn('#__k2_items'))->where($db->qn('id') . '=' . $inputId);
				$db->setQuery($thisQuery);

				$assicatedCatID = $db->loadResult();

				// Exclude active article id
				$query->where($db->qn('a.id') . ' <> ' . (int) $inputId);

				// Only associated category articles
				$query->where($db->qn('a.catid') . ' = ' . (int) $assicatedCatID);
			}
		}

		return $query;
	}
}
