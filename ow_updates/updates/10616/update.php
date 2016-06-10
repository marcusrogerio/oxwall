<?php

/**
 * EXHIBIT A. Common Public Attribution License Version 1.0
 * The contents of this file are subject to the Common Public Attribution License Version 1.0 (the “License”);
 * you may not use this file except in compliance with the License. You may obtain a copy of the License at
 * http://www.oxwall.org/license. The License is based on the Mozilla Public License Version 1.1
 * but Sections 14 and 15 have been added to cover use of software over a computer network and provide for
 * limited attribution for the Original Developer. In addition, Exhibit A has been modified to be consistent
 * with Exhibit B. Software distributed under the License is distributed on an “AS IS” basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for the specific language
 * governing rights and limitations under the License. The Original Code is Oxwall software.
 * The Initial Developer of the Original Code is Oxwall Foundation (http://www.oxwall.org/foundation).
 * All portions of the code written by Oxwall Foundation are Copyright (c) 2011. All Rights Reserved.

 * EXHIBIT B. Attribution Information
 * Attribution Copyright Notice: Copyright 2011 Oxwall Foundation. All rights reserved.
 * Attribution Phrase (not exceeding 10 words): Powered by Oxwall community software
 * Attribution URL: http://www.oxwall.org/
 * Graphic Image as provided in the Covered Code.
 * Display of Attribution Information is required in Larger Works which are defined in the CPAL as a work
 * which combines Covered Code or portions thereof with code not governed by the terms of the CPAL.
 */

$config = OW::getConfig();

// add configs
if ( !$config->configExists('base', 'seo_sitemap_entities') )
{
    $config->addConfig('base', 'seo_sitemap_entities', json_encode(array()));
}

if ( !$config->configExists('base', 'seo_sitemap_schedule_update') )
{
    $config->addConfig('base', 'seo_sitemap_schedule_update', 'weekly');
}

// register sitemap entities
Updater::getSeoService()->addSitemapEntity('admin', 'seo_sitemap_users', 'users', array(
    'user_list'
), 'seo_sitemap_users_desc');

// add the SEO admin menu
try
{
    OW::getNavigation()->addMenuItem(
        OW_Navigation::ADMIN_SETTINGS,
        'admin_settings_seo',
        'admin',
        'sidebar_menu_item_seo_settings',
        OW_Navigation::VISIBLE_FOR_ALL);
}
catch ( Exception $e )
{
    Updater::getLogger()->addEntry(json_encode($e));
}

// import langs
Updater::getLanguageService()->importPrefixFromDir(__DIR__ . DS . 'langs');
