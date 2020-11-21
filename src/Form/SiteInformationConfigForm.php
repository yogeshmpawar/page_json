<?php

namespace Drupal\page_json\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Site Information Config form which adds site api key in basic site settings.
 */
class SiteInformationConfigForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'system_site_information_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'system.site',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildform($form, $form_state);
    $site_config = $this->config('system.site');

    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Site API Key'),
      '#description' => $this->t('Unique "Site API Key" used for JSON representation of basic page node.'),
      '#default_value' => $site_config->get('siteapikey') ?? $this->t('No API Key yet'),
    ];

    // Change the Submit button label.
    $form['actions']['submit']['#value'] = $this->t('Update Configuration');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Check for empty Site API Key.
    if ($form_state->isValueEmpty('siteapikey')) {
      // Set to default 'No API Key yet'.
      $form_state->setValueForElement($form['site_information']['siteapikey'], 'No API Key yet');
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Saving the Site API Key value in system.site config.
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();

    // Displaying the message for site api key value for users.
    $this->messenger()->addStatus($this->t('The Site API Key "@key" is saved in Basic site settings.', ['@key' => $form_state->getValue('siteapikey')]));

    parent::submitForm($form, $form_state);
  }

}
