<?php
class SidebareSiteConfigExtension extends DataExtension {

  private static $has_one = [
    'HideSidebar' => 'Boolean',
  ];

  private static $has_many = [
    'SidebarTemplates' => 'SidebarTemplate',
  ];

  public function updateCMSFields(FieldList $fields) {
    $fields->addFieldsToTab('Root.Main.MainTabs.Sidebar', [
      DropdownField::create('HideSidebar', 'Sidebar verstecken', [1 => 'Ja', 0 => 'Nein'], 0),
      GridField::create('SidebarTemplates', 'Sidebar Templates', $this->owner->SidebarTemplates(), SidebarGridConfig::create()),
    ]);
  }
}