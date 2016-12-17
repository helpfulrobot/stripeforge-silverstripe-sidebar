<?php
class SidebarPageExtension extends DataExtension {

  private static $db = [
    'SidebarTemplateAttached' => 'Boolean'
  ];

  private static $many_many = [
    'SidebarWidgets' => 'SidebarWidget'
  ];

  private static $many_many_extraFields = [
    'SidebarWidgets' => ['SortOrder' => 'Int']
  ];

  public function onBeforeWrite() {
    parent::onBeforeWrite();

    if(!$this->owner->SidebarTemplateAttached && $this->owner->ID && $template = SidebarTemplate::get()->find('PageType', $this->owner->ClassName)) {
      $this->owner->addSidebarWidgets($template);
      $this->owner->SidebarTemplateAttached = true;
    }
  }

  public function addSidebarWidgets($template) {
    foreach($template->SidebarWidgets() as $widget) {
      $this->owner->SidebarWidgets()->add($widget, ['SortOrder' => $widget->SortOrder]);      
    }
  }

  public function updateCMSFields(FieldList $fields) {
    $fields->addFieldsToTab('Root.Sidebar', [
      DropdownField::create('HideSidebar', 'Sidebar anzeigen', [2 => 'Ja', 1 => 'Nein', 3 => 'Von der übergeordneten Seite erben'], 3),
      GridField::create('SidebarWidgets', 'Widgets', $this->owner->SidebarWidgets(), SFGrid_Relation_Multi::create(30, false, 'SortOrder')),
    ]);
  }
}