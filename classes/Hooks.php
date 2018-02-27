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
        if($_GET['FOO'] == 'BAR')
        {
            ob_start();
            print_r($strBuffer);
            print "\n";
            file_put_contents(TL_ROOT . '/debug.txt', ob_get_contents(), FILE_APPEND);
            ob_end_clean();
        }

        $strBuffer = static::hyphenate($strBuffer);

        if($_GET['FOO'] == 'BAR')
        {
            ob_start();
            print_r("##############################################################################\n");
            print_r($strBuffer);
            print "\n";
            file_put_contents(TL_ROOT . '/debug.txt', ob_get_contents(), FILE_APPEND);
            ob_end_clean();
        }

        return $strBuffer;
    }

}