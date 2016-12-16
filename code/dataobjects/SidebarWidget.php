<?php
class SidebarWidget extends DataObject {

  private static $singular_name = 'Text / Vorgefertigter Inhalt';
  private static $plural_name = 'Text / Vorgefertigter Inhalt';

  private static $db = [
    'Title' => 'Varchar(255)',
    'ShowTitle' => 'Boolean',
    'Content' => 'HTMLText',
    'ExtraContent' => 'Varchar(20)'
  ];

  private static $has_one = [];
  private static $belongs_to = [];
  private static $has_many = [];
  private static $many_many = [];
  private static $belongs_many_many = [
    'Pages' => 'Page'
  ];

  // private static $many_many_extraFields = [
  //   'RelationName' =>['FieldName' => 'FieldType']
  // ];

  private static $searchable_fields = [];
  private static $summary_fields = [
    'Title' => 'Titel',
    'ShowTitle.Nice' => 'Titel anzeigen',
    'ExtraContent' => 'Vorgefertigter Inhalt'
  ];

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
    $requiredFields = parent::getCMSValidator();
    // $requiredFields->addRequiredField('FieldName');
    // $requiredFields = RequiredFields::create('Title');
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
    // $fields = parent::getCMSFields();
    // $fields->addFieldsToTab('Root.Main', []);
    
    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          TextField::create('Title', 'Titel')
            ->setRightTitle('[title] = aktueller Seitentitel'),
          DropdownField::create('ShowTitle', 'Titel anzeigen', [1 => 'Ja', 0 => 'Nein'], 1),
          DropdownField::create('ExtraContent', 'Vorgefertigte Inhalte', [
            'navigation' => 'Navigation / Unterseiten',
            'contact' => 'Kontaktdaten',
            'address' => 'Adresse',
            'socialmedia' => 'Social Media'
          ])->setEmptyString('(Bitte auswählen)'),
          HTMLEditorField::create('Content', 'Inhalt')
            ->setRows(15)
        )
      )
    );

    return $fields;
  }

  public function WidgetLayout() {
    return $this->renderWith($this->ClassName);
  }
}