<?php

namespace Drupal\page_json\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Route Subscriber to alter route for site information settings collection.
 */
class PageJsonRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Load route for site information settings collection.
    if ($route = $collection->get('system.site_information_settings')) {
      // Sets a default value that will be added to above loaded route.
      $route->setDefault('_form', 'Drupal\page_json\Form\SiteInformationConfigForm');
    }
  }

}
