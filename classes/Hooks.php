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


class Hooks extends Hyphenator
{

    public function modifyFrontendPageHook($strBuffer, $strTemplate)
    {
        return static::hyphenate($strBuffer);
    }

}