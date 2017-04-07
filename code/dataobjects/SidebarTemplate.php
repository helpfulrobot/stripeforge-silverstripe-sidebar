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

  private static $many_many = [
    'SidebarWidgets' => 'SidebarWidget'
  ];

  private static $many_many_extraFields = [
    'SidebarWidgets' => ['SortOrder' => 'Int']
  ];

  private static $summary_fields = [
    'Title' => 'Titel',
    'PageType' => 'Seitentyp',
    'SidebarWidgets.Count' => 'Widgets'
  ];

  public function onBeforeWrite() {
    parent::onBeforeWrite();

    $this->Title = 'Sidebar "' . $this->PageType . '" Template';
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
    $can = true;
    return $can;
  }

  public function validate() {
    $result = parent::validate();

    if(SidebarTemplate::get()->exclude('ID', $this->ID)->find('PageType', $this->PageType)) {
      $result->error('Ein Sidebar Template für diesen Seitentyp existiert bereits.');
    }

    return $result;
  }

  private static $better_buttons_actions = array (
    'syncPages'
  );

 public function getBetterButtonsActions() {
    $fields = parent::getBetterButtonsActions();
    if($this->ID) {
      $fields->push(BetterButtonCustomAction::create('syncPages', 'Synchronisieren'));
    }
    return $fields;
  }

  public function syncPages() {
    if($className = $this->PageType) {
      $pages = $className::get()->filter('ClassName', $className);
      
      foreach($pages as $page) {
        $page->addSidebarWidgets($this);
      }

      return 'Sidebar Widgets wurden über alle Seiten vom Typ "' . $this->PageType . '" hinweg synchronisiert.';
    }
  }

  public function getCMSFields() {
    $pageTypeSrc = ClassInfo::subclassesFor('Page');

    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          DropdownField::create('PageType', 'Seitentyp', $pageTypeSrc),
          GridField::create('SidebarWidgets', 'Widgets', $this->owner->SidebarWidgets(), $gc = SidebarGridConfig::create(30, 'SortOrder'))
        )
      )
    );

    if(!$this->ID) {
      $fields->removeByName('SidebarWidgets');
      $fields->insertAfter(LiteralField::create('Notice', '<div class="message notice">Nach dem speichern können Widgets hinzugefügt werden.</div>'), 'PageType');
    } else {
      $gc->set(['relation', 'multi']);
    }

    return $fields;
  }
}