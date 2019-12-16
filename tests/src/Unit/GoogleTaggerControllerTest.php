<?php

namespace Drupal\Tests\google_tagger\Unit;

use Drupal\google_tagger\Controller\GoogleTaggerController;
use Drupal\Tests\UnitTestCase;

/**
 * Tests GoogleTAGController element.
 *
 * @coversDefaultClass \Drupal\google_tagger\Controller\GoogleTAGController;
 */
/**
 * Provides a Google TAG form variable.
 */
class GoogleTaggerControllerTest extends UnitTestCase {

  /**
   * Test if arrays are the same.
   *
   * @param array $expected
   *   Expected array.
   * @param array $actual
   *   Actual array passed.
   * @param string $msg
   *   Message to printout.
   */
  // public function assertArrayStructure(array $expected, array $actual, $msg = '') {
  //   ksort($expected);
  //   ksort($actual);
  //   $this->assertSame($expected, $actual, $msg);
  // }

  /**
   * {@inheritdoc}
   */
  public function testGetTaggerId() {


    // $resourceManager = $this->getMockBuilder('Drupal\google_tagger\Controller\GoogleTAGController')->disableOriginalConstructor()->getMock();

    // $this->container->set('google_tagger.settings', $resourceManager);
    //$environment = \Drupal::service('twig');
    //$config = \Drupal::config('google_tagger.settings')->get('tag-id');
    //$this->getMockBuilder('Drupal\google_tagger\Controller\GoogleTAGController')->disableOriginalConstructor()->getMock();
    //$this->getMockBuilder('Drupal\Core\Config\ConfigFactory')->disableOriginalConstructor()->getMock();
    //$config = $this->config('google_tagger.settings');
    //$config  = $this->container->get('google_tagger.settings');

    $googleTAGController = new GoogleTaggerController();
    $tagArray = $googleTAGController->getTaggerId();


    $this->assertArrayEquals([
      '#theme' => 'google-tagger-id',
      '#google_tagger_id' => preg_match('/gtm-\w{7}/i', $tagArray['#google_tagger_id']) || '',
    ],
    $tagArray
    );
  }

}
