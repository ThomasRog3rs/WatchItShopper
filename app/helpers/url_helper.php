<?php
//simple page redirect
function redirect($url){
  header('location: '.URLROOT.$url);
}