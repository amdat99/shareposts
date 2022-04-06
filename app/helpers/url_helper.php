<?php
//simple page redirect
function redirect($location){
  header('Location: ' . URLROOT . '/' . $location);
}

