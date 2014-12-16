<?php

require_once 'modifybyid.civix.php';

//  static function validate($formName, &$fields, &$files, &$form) {

function modifybyid_civicrm_validate($formName, &$fields, &$files, &$form) {
  if ("CRM_Modifybyid_Form_Connect" != $formName) 
    return;
  $cid = $fields["contact_id"];
  if (!$cid || !is_numeric ($cid)) { 
    //lw return array ("contact_id"=> "must be a number");//TODO Fix
    return array ("contact_id"=> "doit être un nombre");//TODO Fix
  }
  $r=civicrm_api ("contact","getsingle", array("version"=>3,"id"=>$cid, "contact_type"=> "Individual","return"=>"last_name"));
  if (array_key_exists ("is_error",$r)) {
    return array ("contact_id"=> "Record not found, please verify the data");//TODO Fix
  }
  if (trim(strtolower($r["last_name"])) !== trim (strtolower($fields["last_name"])))
      //lw return array ("last_name"=> "Record not found, please verify the last name", "contact_id" => "please verify the identifier");//TODO Fix
      return array ("last_name"=> "Veuillez vérifier votre saisie", "contact_id" => "Veuillez vérifier votre saisie");//TODO Fix
}


function aaamodifybyid_civicrm_postProcess($formName, &$form) {
  if ("CRM_Modifybyid_Form_Connect" != $formName) 
    return;
  $cid = $form["contact_id"];
  $url = "civicrm/profile/edit";//?gid=1&reset=1&id=4
  $checksum = CRM_Contact_BAO_Contact_Utils::generateChecksum($cid);
  $url = CRM_Utils_System::url('civicrm/profile/edit','gid=1&reset=1&id='.$cid."&cs=".$checksum);
die ($url);
CRM_Utils_System::redirect($this->_destination);
}

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function modifybyid_civicrm_config(&$config) {
  _modifybyid_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function modifybyid_civicrm_xmlMenu(&$files) {
  _modifybyid_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function modifybyid_civicrm_install() {
  _modifybyid_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function modifybyid_civicrm_uninstall() {
  _modifybyid_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function modifybyid_civicrm_enable() {
  _modifybyid_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function modifybyid_civicrm_disable() {
  _modifybyid_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function modifybyid_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _modifybyid_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function modifybyid_civicrm_managed(&$entities) {
  _modifybyid_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function modifybyid_civicrm_caseTypes(&$caseTypes) {
  _modifybyid_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function modifybyid_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _modifybyid_civix_civicrm_alterSettingsFolders($metaDataFolders);
}
