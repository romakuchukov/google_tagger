<?php

namespace Drupal\google_tagger\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Google TAG form variable.
 */
class GoogleTaggerController extends ControllerBase {

  /**
   * Declare config field.
   *
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $config;

  /**
   * Constructs a new Config object.
   *
   * @param Drupal\Core\Config\ConfigFactoryInterface $config
   *   Creates config for the module.
   */
  public function __construct(ConfigFactoryInterface $config) {
    $this->config = $config->get('google_tagger.settings');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('config.factory'));
  }

  /**
   * {@inheritdoc}
   */
  public function getTaggerId() {

    return [
      '#theme' => 'google-tagger-id',
      '#google_tagger_id' => $this->config->get('tagger-id'),
    ];
  }

}
