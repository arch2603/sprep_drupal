<?php

namespace Drupal\drupalsprep\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
//use Drupal\file\Entity\File;


class SPREPForm extends FormBase
{

  // public function getEditableConfigNames()
  // {
  //   return ['drupalsprep.company'];
  // }

  public function getFormId()
  {
    return 'sprepform_example_form';
  }

  // public function getFormId()
  // {
  //   return 'drupalsprep_example_form';
  // }

  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    );

    $form['cresidence'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Country Of Residence'),
    );

    $form['qualification'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Qualifications'),
    );

    $form['experience'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Description of experience'),
    );
    $format = 'd-m-y';
    $form['pst'] = array(
      '#type' => 'date',
      '#date_format' => $format,
      '#title' => $this->t('Preferred Start Date'),
    );

    $form['adoc'] = array(
      '#type' => 'managed_file',
      '#title' => $this->t('Attached Documents'),
      '#multiple' => TRUE,
      '#description' => t("Maximum fileaise: <strong>10 MB</strong> | Allowed Extensions: <strong> PDF DOC DOCX JPEG JPG PNG TXT
      </strong>"),
      '#progress_message' => $this->t('Please wait...'),
      'upload_validators' => array(
        'file_validate_extensions' => array('pdf doc docx jpeg jpg png txt'),
      ),
      '#upload_location' => 'public://files/',

    );

    // $form['company_name'] = array(
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Company Name'),
    //   '#default_value' => $this->config('drupalsprep.company')->get('name'),
    // );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
    //return parent::buildForm($form, $form_state);
  }

  public function validateForm(array &$form, FormStateInterface $form_state)
  {

  }

  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    // parent::submitForm($form, $form_state);
    // $this->config('drupalsprep.company')->set('name', $form_state->getValue('company_name'));
    $conn = Database::getConnection();
    $file_submitted = file_save_upload('adoc', array(
      'file_validate_extensions' => array('pdf doc docx jpeg jpg png txt'),
      'custom_validate_size' => array(1024 * 1024 * 30),
    )
  );//array

    //saving file to new location
    $files = $form_state->getValue('adoc');
    $file = \Drupal\file\Entity\File::load($files[0]);
    $file->setPermanent();
    $file->save();

    $uri = $file->getFileUri();


    $conn->insert('expression_of_interest')->fields(
      array(
          'name' => $form_state->getValue('name'),
          'country_residence'=> $form_state->getValue('cresidence'),
          'qualifications'=> $form_state->getValue('qualification'),
          'desc_experience'=> $form_state->getValue('experience'),
          'date'=> $form_state->getValue('pst'),
          'attached_doc' =>$uri,
      )
    )->execute();

    $url = Url::fromRoute('drupalsprep.successpage');
    $form_state->setRedirectUrl($url);

  }


}




?>
