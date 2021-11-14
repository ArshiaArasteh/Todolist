<?php

function diePage($msg){
    echo "<div style = 'background: #a70808; color: white; padding: 20px ; border: 2px solid white; border-radius: 10px ; width: 800px ; text-align: center; margin: auto; margin-top: 20px ;'>$msg</div>";
    die();
}

function isAjaxRequest(){
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{    
  return true;    
}
return false;

}

function site_url($url = ''){
  return BASE_URL . $url;
}

function dd($value){
  echo "<pre>";
  var_dump($value);
  echo "</pre>";
  die();
}