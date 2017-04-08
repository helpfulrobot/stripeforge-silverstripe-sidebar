<?php
class SidebarPageExtension extends DataExtension {

  private static $db = [
    'SidebarTemplateAttached' => 'Boolean',
    'HideSidebar' => 'Int',
  ];

  private static $many_many = [
    'SidebarWidgets' => 'SidebarWidget'
  ];

  private static $many_many_extraFields = [
    'SidebarWidgets' => ['SortOrder' => 'Int']
  ];

  public function populateDefaults() {
    parent::populateDefaults();

    $this->HideSidebar = 3;
  }

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
      GridField::create('SidebarWidgets', 'Widgets', $this->owner->SidebarWidgets(), $gc = SidebarGridConfig::create(30, 'SortOrder')),
    ]);

    $gc->set(['relation', 'multi']);

    if(!$this->owner->SidebarTemplateAttached && SidebarTemplate::get()->find('PageType', $this->owner->ClassName)) {
      $fields->insertAfter(LiteralField::create('Notice', '<div class="message notice">Nach dem speichern werden die im Template hinterlegten Widgets hinzugefügt.</div>'), 'SidebarWidgets');
    }
  }
}