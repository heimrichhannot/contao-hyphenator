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

namespace HeimrichHannot\Hyphenator;


class Hyphenator extends \Controller
{
	public static function hyphenate($strBuffer)
	{
		global $objPage;

		$arrSkipPages = \Config::get('hyphenator_skipPages');

		if(is_array($arrSkipPages) && in_array($objPage->id, $arrSkipPages))
		{
			return $strBuffer;
		}

		$o = new \Org\Heigl\Hyphenator\Options();

		$o->setHyphen(\Config::get('hyphenator_hyphen'))
				->setDefaultLocale(static::getLocaleFromLanguage($objPage->language))
				->setRightMin(\Config::get('hyphenator_rightMin'))
				->setLeftMin(\Config::get('hyphenator_leftMin'))
				->setWordMin(\Config::get('hyphenator_wordMin'))
				->setFilters(\Config::get('hyphenator_filter'))
				->setQuality(\Config::get('hyphenator_quality'))
				->setTokenizers(\Config::get('hyphenator_tokenizers'));

		$h = new \Org\Heigl\Hyphenator\Hyphenator();
		$h->setOptions($o);

		$doc = \phpQuery::newDocumentHTML($strBuffer);

		foreach(pq('body')->find(\Config::get('hyphenator_tags')) as $n => $item)
		{
			$strText = pq($item)->html();

			// ignore html tags, otherwise &shy; will be added to links for example
			if($strText != strip_tags($strText))
			{
				continue;
			}

			$strText = str_replace('&shy;', '', $strText); // remove manual &shy; html entities before

			$strText = $h->hyphenate($strText);

			if(is_array($strText))
			{
				$strText = current($strText);
			}

			pq($item)->html($strText);
		}

		return $doc->htmlOuter();
	}

	private static function getLocaleFromLanguage($strLanguage)
	{
		$locales = array_keys(\Controller::getLanguages());
		$locale = $strLanguage;
		
		foreach($locales as $l)
		{
			$regex = '/' . $strLanguage . '\_[A-Z]{2}$/';

			if(preg_match($regex, $l))
			{
				$locale = $l;
				break;
			}
		}
		
		return $locale;
	}
}