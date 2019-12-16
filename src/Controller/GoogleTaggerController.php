<?php

namespace Drupal\google_tagger\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides a Google TAG form variable.
 */
class GoogleTaggerController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function getTaggerId() {

    return [
      '#theme' => 'google-tagger-id',
      '#google_tagger_id' => \Drupal::config('google_tagger.settings')->get('tagger-id'),
    ];
  }

}
