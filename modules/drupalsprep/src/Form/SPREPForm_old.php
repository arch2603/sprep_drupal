<?php

namespace Drupal\drupalsprep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class SPREPForm extends FormBase{

  public function getFormId()
  {
    return 'drupalsprep_example_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    );

    $form['cresidence'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Country of residence'),
    );

    $form['qualification'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Qualifications'),
    );

    $form['experience'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Description of experience'),
    );

    $form['pst'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Preferred Start Date'),
    );

    $form['adoc'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Attached Documents'),
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    );

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {

  }


}




?>
