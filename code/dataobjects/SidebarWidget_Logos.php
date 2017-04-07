<?php
class SidebarWidget_Logos extends SidebarWidget {

  private static $singular_name = 'Logos';
  private static $plural_name = 'Logos';
  private static $many_many = [
    'Logos' => 'SidebarLinkedImage'
  ];

  private static $many_many_extraFields = [
    'Logos' =>['SortOrder' => 'Int']
  ];

  private static $default_sort = 'Title';

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
    $can = true;
    return $can;
  }

  public function getCMSValidator() {
    $requiredFields = RequiredFields::create('Title');
    return $requiredFields;
  }

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->removeByName('Content');
    $fields->addFieldsToTab('Root.Main', [
      SortableUploadField::create('Logos')
        ->setFoldername('sidebar/logos')
        ->setDisplayFoldername('sidebar/logos')
    ]);

    $this->extend('updateCMSFields', $fields);

    return $fields;
  }
}