<?php

namespace Drupal\nm_loremipsum\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form to configure Lorem Ipsum Generator's settings.
 */
class LoremIpsumAdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'loremipsum_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('nm_loremipsum.settings');

    // Page title field.
    $form['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lorem ipsum generator Page Title:'),
      '#default_value' => $config->get('nm_loremipsum.page_title'),
      '#description' => $this->t('Give a page title to your Lorem Ipsum Generator page.'),
    ];
    // Source text field.
    $form['source_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Source text for Lorem Ipsum Generation:'),
      '#default_value' => $config->get('nm_loremipsum.source_text'),
      '#description' => $this->t('Write one sentence per line. Those sentences will be used to generate random text.'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('nm_loremipsum.settings');
    $config->set('nm_loremipsum.source_text', $form_state->getValue('source_text'));
    $config->set('nm_loremipsum.page_title', $form_state->getValue('page_title'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'nm_loremipsum.settings',
    ];
  }

}
