<?php

namespace Drupal\google_tagger\Form;

use Drupal\Core\Url;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Google TAG form.
 */
class GoogleTaggerForm extends FormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'google_tagger.settings';
  const GTM = 'GTM-XXXXXXX';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'google_tagger_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [static::SETTINGS];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config(static::SETTINGS);
    // sanitizing.
    $form['tagger-id'] = [
      '#type' => 'textfield',
      '#maxlength' => 12,
      '#size' => 12,
      '#title' => $this->t('Container ID (@gtm)', ['@gtm' => static::GTM]),
      '#placeholder' => static::GTM,
      '#description' => $this->t('Please provide you Google Tag container ID (@gtm) in the field above.', ['@gtm' => static::GTM]),
      '#default_value' => $config->get('tagger-id'),
      '#required' => TRUE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save configuration'),
      '#button_type' => 'primary',
    ];

    // By default, render the form using system-config-form.html.twig.
    $form['#theme'] = 'system_config_form';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    // GTM-N973DM9
    // GTM-XXXXXXX.
    $tagID = trim($form_state->getValue('tagger-id'));

    if (!preg_match('/gtm-\w{7}/i', $tagID)) {
      $form_state->setErrorByName('tagger-id', $this->t('Please check accuracy of your Container Tag ID'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->configFactory->getEditable(static::SETTINGS)
      // Set the submitted configuration setting.
      ->set('tagger-id', trim($form_state->getValue('tagger-id')))
      ->save();

    $this->messenger()->addStatus($this->t('Check your Google Tag administration page to make sure you are connected.'));
    $form_state->setRedirectUrl(Url::fromRoute('google_tagger.settings'));

  }

}
