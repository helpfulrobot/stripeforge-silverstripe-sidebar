<?php
class SidebarWidget extends DataObject {

  private static $singular_name = 'Text';
  private static $plural_name = 'Texte';

  private static $db = [
    'Title' => 'Varchar(255)',
    'ShowTitle' => 'Boolean',
    'Content' => 'HTMLText',
  ];

  private static $belongs_many_many = [
    'Pages' => 'Page'
  ];

  private static $summary_fields = [
    'Title' => 'Titel',
    'ShowTitle.Nice' => 'Titel anzeigen',
  ];

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

  public function getCMSFields() {
    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          TextField::create('Title', 'Titel')
            ->setRightTitle('[title] = aktueller Seitentitel'),
          DropdownField::create('ShowTitle', 'Titel anzeigen', [1 => 'Ja', 0 => 'Nein'], 1),
          HTMLEditorField::create('Content', 'Inhalt')
            ->setRows(15)
        )
      )
    );

    $this->extend('updateCMSFields', $fields);

    return $fields;
  }

  public function WidgetLayout() {
    return $this->renderWith($this->ClassName);
  }
}