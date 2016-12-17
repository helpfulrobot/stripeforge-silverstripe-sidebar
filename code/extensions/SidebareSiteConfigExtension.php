<?php
class SidebareSiteConfigExtension extends DataExtension {

  private static $has_many = [
    'SidebarTemplates' => 'SidebarTemplate'
  ];

  public function updateCMSFields(FieldList $fields) {
    $misc = $fields->findOrMakeTab('Root.Sonstiges');
    $misc->Fields()->addFieldsToTab('SonstigesTabs.Sidebar', [
      GridField::create('SidebarTemplates', 'Sidebar Templates', $this->owner->SidebarTemplates(), SFGrid::create()),
    ]);
  }
}