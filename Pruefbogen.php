<?php

class Pruefbogen {

  public $dateiname;
  public $email;
  public $antworten;

  public function bauePB() {

    $daten = Speicher::laden();
    
    $pb = new Pruefbogen();

    $pb->fragendatei = $daten[0];
    $pb->email = $daten[1];

    if (!empty($daten[2])) {
      for ($index = 2; $index < count($daten); $index++) {
        if (!empty($daten[$index])) {
          $pb->antworten[] = $daten[$index];
        }
      }
    }
    return $pb;
  }

  public function checkeAntworten($fragen, $pb, $antwortNr) {

    if (!empty($pb->antworten)) {
      foreach ($fragen as $frage) {
        foreach ($frage->antworten as $antwort) {
          if ($antwort->nummer == $antwortNr) {
            $gesuchteFrage = $frage;
          }
        }
      }

      foreach ($gesuchteFrage->antworten as $value) {
        $pos = array_search($value->nummer, $pb->antworten);
        if ($pos !== FALSE) {
          unset($pb->antworten[$pos]);
        }
      }
      $pb->antworten[] = $antwortNr;
    } else {
      $pb->antworten[] = $antwortNr;
    }
    return $pb;
  }
  
  public function PBanlegen($kommando) {

    $pb = new Pruefbogen();
    $pb->fragendatei = $kommando['Fragendatei'];
    $pb->email = $kommando['Email'];
    
    Speicher::speichernPB($pb);
    
    
    
    return $pb;
  }

}
