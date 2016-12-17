<?php
class SidebarTemplate extends DataObject {

  private static $singular_name = 'Sidebar Template';
  private static $plural_name = 'Sidebar Templates';

  private static $db = [
    'Title' => 'Varchar(255)',
    'PageType' => 'Varchar(255)'
  ];

  private static $has_one = [
    'SiteConfig' => 'SiteConfig'
  ];

  private static $belongs_to = [];
  private static $has_many = [];

  private static $many_many = [
    'SidebarWidgets' => 'SidebarWidget'
  ];

  private static $many_many_extraFields = [
    'SidebarWidgets' => ['SortOrder' => 'Int']
  ];

  private static $belongs_many_many = [];
  private static $searchable_fields = [];
  private static $summary_fields = [];

  // private static $default_sort = ;
  private static $defaults = [];

  public function populateDefaults() {
    parent::populateDefaults();
  }

  public function onBeforeWrite() {
    parent::onBeforeWrite();

    $this->Title = 'Sidebar "' . $this->PageType . '" Template';
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

  // public function validate() {
  //   $result = parent::validate();

  //   if($this->Value == 'Key') {
  //     $result->error('Custom Error Message');
  //   }

  //   return $result;
  // }

  public function getCMSFields() {
    // $fields = parent::getCMSFields();
    // $fields->addFieldsToTab('Root.Main', []);

    $pageTypeSrc = ClassInfo::subclassesFor('Page');

    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          DropdownField::create('PageType', 'Seitentyp', $pageTypeSrc),
          GridField::create('SidebarWidgets', 'Widgets', $this->owner->SidebarWidgets(), SFGrid_Relation_Multi::create(30, false, 'SortOrder'))
        )
      )
    );

    if(!$this->ID) {
      $fields->removeByName('SidebarWidgets');
    }

    return $fields;
  }
}