<?php
class SidebarPageExtension extends DataExtension {

  private static $many_many = [
    'SidebarWidgets' => 'SidebarWidget'
  ];

  private static $many_many_extraFields = [
    'SidebarWidgets' => ['SortOrder' => 'Int']
  ];

  public function updateCMSFields(FieldList $fields) {
    $fields->addFieldsToTab('Root.Sidebar', [
      DropdownField::create('HideSidebar', 'Sidebar anzeigen', [2 => 'Ja', 1 => 'Nein', 3 => 'Von der übergeordneten Seite erben'], 3),
      GridField::create('SidebarWidgets', 'Widgets', $this->owner->SidebarWidgets(), SFGrid_Relation_Multi::create(30, false, 'SortOrder')),
    ]);
  }
}