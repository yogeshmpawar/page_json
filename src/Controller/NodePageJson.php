<?php

namespace Drupal\page_json\Controller;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller to provide JSON representation for basic page node.
 */
class NodePageJson extends ControllerBase {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * NodePageJson constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * Provides the Basic Page Node in JSON format.
   *
   * @param string $site_key
   *   A Site API Key.
   * @param \Drupal\node\Entity\Node $node
   *   A node object.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   The Node JSON.
   */
  public function renderNodePageJson(string $site_key, Node $node) {
    // Load system site config from config factory.
    $site_config = $this->configFactory->get('system.site');
    // Get siteapikey value from the config.
    $siteApiKey = $site_config->get('siteapikey');

    // Show basic page node in JSON format when siteapikey & node type matches.
    if (!empty($site_key) && !empty($node) && $siteApiKey == $site_key && $node->getType() == 'page') {
      return new JsonResponse($node->toArray(), 200);
    }
    else {
      // Otherwise shows access denied page.
      throw new AccessDeniedHttpException();
    }
  }

}
