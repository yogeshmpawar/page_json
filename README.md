CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * Maintainers

INTRODUCTION
------------

 * This module adds "Site API Key" field in the "Basic Site Settings" site
   details form. This module also provides a URL that responds with a JSON
   representation of a given node with the content type "page". Only if the
   previously submitted API Key and a node id (nid) of an appropriate node
   are present, otherwise it will respond with "access denied".

 * Example URL :- http://localhost/page_json/FOOBAR12345/17
 * Where "FOOBAR12345" is a site api key saved in basic site settings
 * Where "17" is the node id of basic page content type.

 * For a full description of the module, visit the project page:
   https://github.com/yogeshmpawar/page_json

REQUIREMENTS
------------

 - No special requirements.

INSTALLATION
------------

 * Module: Install as you would normally install a contributed Drupal module.
   See: https://www.drupal.org/documentation/install/modules-themes/modules-8
   for further information.

CONFIGURATION
-------------

 * Goto to Basic Site Settings page to setup Site API Key for the site.

MAINTAINERS
-----------

Current maintainers:
 * Yogesh Pawar - https://github.com/yogeshmpawar
