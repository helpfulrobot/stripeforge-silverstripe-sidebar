<?php
class SidebarWidget_Logos extends SidebarWidget {

  private static $singular_name = 'Logos';
  private static $plural_name = 'Logos';

  private static $db = [];
  private static $has_one = [];
  private static $belongs_to = [];
  private static $has_many = [];
  private static $many_many = [
    'Logos' => 'LinkedImage'
  ];

  private static $belongs_many_many = [];
  private static $many_many_extraFields = [
    'Logos' =>['SortOrder' => 'Int']
  ];

  private static $searchable_fields = [];
  private static $summary_fields = [];

  private static $default_sort = 'Title';
  private static $defaults = [];

  public function populateDefaults() {
    parent::populateDefaults();
  }

  public function onBeforeWrite() {
    parent::onBeforeWrite();
  }

  public function onAfterWrite() {
    parent::onAfterWrite();
  }

  public function onBeforeDelete() {
    parent::onBeforeDelete();
  }

  public function onAfterDelete() {
    parent::onAfterDelete();
  }

  
  public function canCreate($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canEdit($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canDelete($member = null) {
    $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEEDITALL']);
    return $can;
  }

  public function canView($member = null) {
    // $can = Permission::check(['ADMIN', 'CMSACCESSLeftAndMain', 'SITETREEVIEWALL']);
    $can = true;
    return $can;
  }

  public function getCMSValidator() {
    $requiredFields = RequiredFields::create('Title');
    return $requiredFields;
  }

  // public function validate() {
  //   $result = parent::validate();

  //   if($this->Value == 'Key') {
  //     $result->error('Custom Error Message');
  //   }

  //   return $result;
  // }

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->removeByName('ExtraContent');
    $fields->removeByName('Content');
    $fields->addFieldsToTab('Root.Main', [
      SortableUploadField::create('Logos')
        ->setFoldername('sidebar/logos')
        ->setDisplayFoldername('sidebar/logos')
    ]);

    return $fields;
  }
}