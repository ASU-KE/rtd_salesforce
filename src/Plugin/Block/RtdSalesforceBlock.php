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
    $list_id = $this->configuration['list_id'];
    $member_id = $this->configuration['member_id'];
    $success_page = $this->configuration['success_page'];
    $unsubscribed_page = $this->configuration['unsubscribed_page'];
    $error_page = $this->configuration['error_page'];

    $form['list_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('List ID'),
      '#description' => $this->t('Add a Salesforce list ID.'),
      '#default_value' => $list_id,
      '#required' => true
    ];

    $form['member_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Member ID'),
      '#description' => $this->t('Add a Salesforce member ID.'),
      '#default_value' => $member_id,
      '#required' => true
    ];

    $form['success_page'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subscribed page'),
      '#description' => $this->t('Enter your thank you page.'),
      '#default_value' => $success_page,
      '#required' => true
    ];

    $form['unsubscribed_page'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Unsubscribed page'),
      '#description' => $this->t('Enter your success unsub page.'),
      '#default_value' => $unsubscribed_page,
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

    $this->configuration['list_id'] = $form_state->getValue('list_id');
    $this->configuration['member_id'] = $form_state->getValue('member_id');
    $this->configuration['success_page'] = $form_state->getValue('success_page');
    $this->configuration['unsubscribed_page'] = $form_state->getValue('unsubscribed_page');
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
      '#list_id' => $config['list_id'],
      '#member_id' => $config['member_id'],
      '#success_page' => $config['success_page'],
      '#unsubscribed_page' => $config['unsubscribed_page'],
      '#error_page' => $config['error_page'],
    ];

    return $build;
  }

}
