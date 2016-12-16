<?php
class SidebarPageControllerExtension extends DataExtension {

  public function onBeforeInit() {
    global $moduleSidebar;

    // - Requirements Management CSS Files
    $moduleCSSFiles = Session::get('SFModuleCSSFiles');

    if(!$moduleCSSFiles) {
      $moduleCSSFiles = [];
    }

    $requiredCSSFiles = array_flip([
      $moduleSidebar . '/css/sidebar.css',
    ]);

    $requiredCSSFiles = array_merge($moduleCSSFiles, $requiredCSSFiles);
    Session::set('SFModuleCSSFiles', $requiredCSSFiles);
  }

  public function updateSidebarHasContent(Boolean $bool) {
    if($this->owner->SidebarWidgets()->first()) {
      $bool->setValue(true);
    } else {
      $bool->setValue(false);
    }
  }
}