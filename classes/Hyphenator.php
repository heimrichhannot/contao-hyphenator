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

use Wa72\HtmlPageDom\HtmlPageCrawler;

class Hyphenator extends \Controller
{
    public static function hyphenate($strBuffer)
    {
        global $objPage;

        $arrSkipPages = \Config::get('hyphenator_skipPages');

        if (is_array($arrSkipPages) && in_array($objPage->id, $arrSkipPages)) {
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

        $doc = HtmlPageCrawler::create($strBuffer);

        $doc->filter(\Config::get('hyphenator_tags'))->each(function ($node, $i) use ($h) {
            /** @var $node  HtmlPageCrawler */
            $text = $node->html();

            // ignore html tags, otherwise &shy; will be added to links for example
            if ($text != strip_tags($text)) {
                return $node;
            }

            $text = str_replace('&shy;', '', $text); // remove manual &shy; html entities before

            $text = $h->hyphenate($text);

            if (is_array($text)) {
                $text = current($text);
            }

            $node->html($text);

            return $node;
        });

        return $doc->saveHTML();
    }

    private static function getLocaleFromLanguage($strLanguage)
    {
        $locales = array_keys(\Controller::getLanguages());
        $locale  = $strLanguage;

        foreach ($locales as $l) {
            $regex = '/' . $strLanguage . '\_[A-Z]{2}$/';

            if (preg_match($regex, $l)) {
                $locale = $l;
                break;
            }
        }

        return $locale;
    }
}