<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces([
    'HeimrichHannot',
]);


/**
 * Register the classes
 */
ClassLoader::addClasses([
    // Classes
    'HeimrichHannot\Hyphenator\Hyphenator' => 'system/modules/hyphenator/classes/Hyphenator.php',
    'HeimrichHannot\Hyphenator\Hooks'      => 'system/modules/hyphenator/classes/Hooks.php',
]);
