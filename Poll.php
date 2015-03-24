<?php

include 'Aktionen.php';

$aktionen = new Aktionen();

switch ($argv[1]) {
  case $argv[1] == 'starten':
    $aktionen->starten();
    break;
  case $argv[1] == 'antworten':
    $aktionen->antworten();
    break;
  case $argv[1] == 'auswerten':
    $aktionen->auswerten();
    break;
}
