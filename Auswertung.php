<?php

class Auswertung {

  public function erstellen($antworten, $fragen) {

    $richtigeFragen = 0;
    $indexFrage = count($fragen);
    foreach ($antworten as $value) {
      foreach ($fragen as $frage) {
        foreach ($frage->antworten as $antwort) {
          if ($antwort->antwort == TRUE AND $antwort->nummer == $value) {
            $richtigeFragen ++;
          }
        }
      }
    }

    $auswertung = "Du hast von $indexFrage Fragen, $richtigeFragen richtig beantwortet.";
    
    return $auswertung;
  }

}
