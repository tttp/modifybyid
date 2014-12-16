<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Modifybyid_Form_Connect extends CRM_Core_Form {
  function buildQuickForm() {

    // add form elements
    $this->add(
      'text', // field type
      'last_name', // field name
      //lw ts('Last name'), // field label
      ts('Nom'), // field label
      null, // list of options
      true // is required
    );
    $this->add(
      'text', // field type
      'contact_id', // field name
      //lw ts('Identifier'), // field label
      ts('Mot de passe'), // field label
      null, // list of options
      true // is required
    );
    $this->addButtons(array(
      array(
        'type' => 'submit',
        //lw 'name' => ts('Submit'),
        'name' => ts('Valider'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  function postProcess() {

    $form = $this->exportValues();

  $cid = $form["contact_id"];
  $checksum = CRM_Contact_BAO_Contact_Utils::generateChecksum($cid);
  $url = "civicrm/profile/edit";//?gid=1&reset=1&id=4
  $url = CRM_Utils_System::url('civicrm/profile/edit','gid=1&reset=1&id='.$cid."&cs=".$checksum);

  CRM_Utils_System::redirect($url);
  parent::postProcess();
  }


  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }
}
