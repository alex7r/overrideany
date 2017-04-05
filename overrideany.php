<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.overrideAny
 *
 * @copyright   Copyright (C) 2017 Alexandr Kosarev @kosarev.by
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Joomla! True Overrides Plugin.
 *
 * @since  3.7
 */
class PlgSystemOverrideAny extends JPlugin
{
	public function onAfterRoute(){
	    $overridables = array();
      $overridables['ContentModelCategory']['initial'] = JPATH_BASE.'/components/com_content/models/category.php';
      $overridables['ContentModelCategory']['target'] = JPATH_BASE.'/core/content/models/category.php';
      foreach ($overridables as $class => $files){
          $files['initial'] = str_replace($class, $class.'Base', file_get_contents($files['initial']));
          $files['initial'] = preg_replace('/^\\<\\?php[^A-z]/','', $files['initial']);
          eval($files['initial']);
          JLoader::register($class, $files['target']);
      }
    }
 }
