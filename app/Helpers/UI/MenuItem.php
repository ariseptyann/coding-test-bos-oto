<?php

namespace App\Helpers\UI;

class MenuItem{
  protected $text;
  protected $url;
  protected $icon;
  protected $parent;
  protected $children = [];
  protected $permissions = [];
  protected $isActive = false;
  protected $isRoute = false;
  protected $badge = null;

  public function __construct($text, $url, $icon = null, $parent = null){
    $this->url    = $url;
    $this->icon   = $icon;
    $this->text   = $text;
    $this->parent = $parent;
  }

  public function add($text, $url, $icon = null){
    $item = new MenuItem($text, $url, $icon);
    $this->children[] = $item;
    return $item;
  }

  public function setIcon($icon){
    $this->icon = $icon;
    return $this;
  }

  public function setBadge($badge){
    $this->badge = $badge;
    return $this;
  }

  public function setPermissions(array $permissions){
    $this->permissions = $permissions;
    return $this;
  }

  public function isRoute(){
    $this->isRoute = true;
    return $this;
  }

  public function checkActive(){
    if($this->isRoute){
      $check = \Route::is($this->url);
    }else{
      $check = \Request::is($this->url);
    }
    return $check;
  }

  public function getParent(){
    return $this->parent;
  }

  public function getText(){
    return $this->text;
  }
  
  public function getUrl(){
    return ($this->isRoute) ? route($this->url) : url($this->url);
  }

  public function getIcon(){
    return $this->icon;
  }

  public function generateBadge($className = ''){
    return $this->badge ? '<span class="'.$className.' float-right mr-2">'.$this->badge.'</span>' : '';
  }
  
  public function getChildren(){
    return $this->children;
  }

  public function countChildren(){
    return count($this->children);
  }
}