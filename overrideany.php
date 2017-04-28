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
    protected static $_overridables = array();

    public function __construct($subject, array $config = array())
    {
        parent::__construct($subject, $config);
        self::$_overridables['ContentModelArticles']['initial'] = JPATH_BASE
            . '/components/com_content/models/articles.php';
        self::$_overridables['ContentModelArticles']['target']  = JPATH_BASE
            . '/core/articles.php';
    }

    public function onAfterRoute()
    {
        foreach (self::$_overridables as $class => $files) {
            if (!class_exists($class . 'Base', false)) {
                $files['initial'] = str_replace($class, $class . 'Base',
                    file_get_contents($files['initial']));
                $files['initial'] = preg_replace('/^\\<\\?php[^A-z]/', '',
                    $files['initial']);
                eval($files['initial']);
                JLoader::register($class, $files['target']);
                JLoader::load($class);
            }
        }
    }
}
