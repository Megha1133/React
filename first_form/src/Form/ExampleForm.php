<?php
namespace Drupal\first_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class ExampleForm extends FormBase {
/**
* {@inheritdoc}
*/
public function getFormId()
{
return 'example_form';
}
/**
* {@inheritdoc}
*/
public function buildForm(array $form, FormStateInterface $form_state)
{
$form['candidate_name'] = array (
  '#type' => 'textfield',
  '#title' => t('Candidate Name:'),
  '#required' => TRUE,
);
$form['candidate_mail'] = array (
  '#type' => 'textfield',
  '#title' => t('Candidate Mail:'),
  '#required' => TRUE,
);
$form['submit'] = array (
  '#type' => 'submit',
  '#value' => t('Save'),
);
return $form;
}
/**
* {@inheritdoc}
*/
public function validateForm(array &$form, FormStateInterface $form_state)
  {
  }
/**
* {@inheritdoc}
*/
public function submitForm(array &$form, FormStateInterface $form_state)
  {
  }
}