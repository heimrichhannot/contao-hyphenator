<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package ${CARET}
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

/**
 * Config
 */
$GLOBALS['TL_CONFIG']['hyphenator_tags'] = 'h1, h2, h3, h4, h5, h6, p';
$GLOBALS['TL_CONFIG']['hyphenator_wordMin'] = 10;
$GLOBALS['TL_CONFIG']['hyphenator_leftMin'] = 5;
$GLOBALS['TL_CONFIG']['hyphenator_rightMin'] = 5;
$GLOBALS['TL_CONFIG']['hyphenator_quality'] = 9;
$GLOBALS['TL_CONFIG']['hyphenator_hyphen'] = '&shy;';
$GLOBALS['TL_CONFIG']['hyphenator_filter'] = 'Simple';
$GLOBALS['TL_CONFIG']['hyphenator_tokenizers'] = array('Whitespace', 'Punctuation');
$GLOBALS['TL_CONFIG']['hyphenator_skipPages'] = array();


/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['modifyFrontendPage'][]  = array('HeimrichHannot\Hyphenator\Hooks', 'modifyFrontendPageHook');

/**
 * Css
 */
if(TL_MODE == 'FE')
{
	$GLOBALS['TL_USER_CSS']['hyphenator'] = 'system/modules/hyphenator/assets/css/hyphenator.min.css' . (version_compare(VERSION, '3.5', '>=') ? '|static' : '');
}