<?php

class Ausgabe {

  public function Auswertung_ausgeben($auswertung) {

    echo "\n  $auswertung\n";
  }

  function gebeFragebogenaus($fragen) {

    foreach ($fragen as $frage) {
      echo "\n$frage->nummer. $frage->frage\n";
      foreach ($frage->antworten as $antwort) {
        echo "  $antwort->nummer. $antwort->text\n";
      }
    }
  }

}
