<?php

namespace Drupal\rtd_salesforce\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "rtd_salesforce_block",
 *   admin_label = @Translation("RTD Salesforce"),
 *   category = @Translation("RTD Salesforce"),
 * )
 */
class RtdSalesforceBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state)
  {
    $form = parent::blockForm($form, $form_state);
    $external_key = $this->configuration['external_key'];
    $client_id = $this->configuration['client_id'];
    $success_page = $this->configuration['success_page'];
    $error_page = $this->configuration['error_page'];

    $form['client_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Client ID'),
      '#description' => $this->t('Add a client ID.'),
      '#default_value' => $client_id,
      '#required' => true
    ];

    $form['external_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('External key'),
      '#description' => $this->t('Add an external key.'),
      '#default_value' => $external_key,
      '#required' => true
    ];

    $form['success_page'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subscribed page'),
      '#description' => $this->t('Enter your thank you page.'),
      '#default_value' => $success_page,
      '#required' => true
    ];

    $form['error_page'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Error page'),
      '#description' => $this->t('Enter your error page.'),
      '#default_value' => $error_page,
      '#required' => true
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state)
  {

    parent::blockSubmit($form, $form_state);

    $this->configuration['external_key'] = $form_state->getValue('external_key');
    $this->configuration['client_id'] = $form_state->getValue('client_id');
    $this->configuration['success_page'] = $form_state->getValue('success_page');
    $this->configuration['error_page'] = $form_state->getValue('error_page');

  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $config = $this->getConfiguration();

    $build = [];

    $build = [
      '#theme' => 'rtd_salesforce',
      '#external_key' => $config['external_key'],
      '#client_id' => $config['client_id'],
      '#success_page' => $config['success_page'],
      '#error_page' => $config['error_page'],
    ];

    return $build;
  }

}
