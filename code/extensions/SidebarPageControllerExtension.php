<?php
class SidebarPageControllerExtension extends DataExtension {

  public function onAfterInit() {
    global $moduleSidebar;
    Requirements::css($moduleSidebar . '/css/sidebar.css');
  }

  public function HideSidebar() {
    if(!$this->owner->HideSidebar || $this->owner->HideSidebar == 1) {
      return true;
    } else if($this->owner->HideSidebar == 2) {
      return $this->owner->SidebarHasContent();
    } else if($this->owner->HideSidebar == 3) {
      if($parent = $this->owner->Parent()) {
        if($parent->ClassName != 'SiteTree') {
          return $parent->HideSidebar();
        } else {
          return SiteConfig::current_site_config()->HideSidebar;
        }
      } else {
        return SiteConfig::current_site_config()->HideSidebar;
      }
    }
  }

  public function SidebarHasContent() {
    $result = Boolean::create();

    if($this->owner->SidebarWidgets()->first()) {
      $result->setValue(true);
    } else {
      $result->setValue(false);
    }

    $this->owner->extend('updateSidebarHasContent', $result);
    
    return $result;
  }
}