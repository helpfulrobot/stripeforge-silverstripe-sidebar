<?php
class LinkedImage extends Image {

  private static $singular_name = 'Verlinktes Bild';
  private static $plural_name = 'Verlinkte Bilder';

  private static $db = [
    'WebsiteLink' => 'Text'
  ];

  public function onBeforeWrite() {
    parent::onBeforeWrite();

    $this->WebsiteLink = Toolbox::urlAddScheme($this->WebsiteLink);
  }

  public function getCMSFields() {
    $fields = parent::getCMSFields();
    $fields->removeByName('OwnerID');
    $fields->removeByName('ParentID');
    $fields->removeByName('Name');
    $fields->removeByName('FocusPoint');

    $fields->insertAfter(TextField::create('WebsiteLink'), 'Title');

    return $fields;
  }
}