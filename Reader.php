<?php

class Reader {

  public function holeFragen($kommando) {

    $daten = fopen($kommando, "r", TRUE);
    while (!feof($daten)) {
      $zeilen[] = fgets($daten, 1024);
    }
    fclose($daten);

    foreach ($zeilen as $value) {

      if (strpos($value, "?") !== FALSE) {
        if (empty($datenarray->antworten)) {
          A:
          $datenarray = new Datenarray();
          $datenarray->fragen = $value;
        } else {
          $meineDaten[] = $datenarray;
          goto A;
        }
      } else {
        $datenarray->antworten[] = $value;
      }
    }
    $meineDaten[] = $datenarray;
    return $meineDaten;
  }

}

class Datenarray {

  public $fragen;
  public $antworten = array();

}
