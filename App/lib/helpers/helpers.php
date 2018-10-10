<?php
function dnd($data)
{

  echo "<pre>";
  var_dump($data);
  echo "</pre>";
  die();
}
function foreach2($data){
foreach ($data as  $value) {
  echo $value;
}

}
function sanitize($dirty)
{
  return htmlentities($dirty, ENT_QUOTES , 'UTF-8');
}
