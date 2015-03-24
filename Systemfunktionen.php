<?php

class Systemfunktionen {

  public $Kommandodaten = array();

  public function Kommandozeile_parsen_starten() {

    $this->Kommandodaten['Fragendatei'] = $_SERVER['argv'][2];
    $this->Kommandodaten['Email'] = $_SERVER['argv'][3];

    return $this->Kommandodaten;
  }

  public function Kommandozeile_parsen_antworten() {

    $this->Kommandodaten['Antwortnummer'] = $_SERVER['argv'][2];

    return $this->Kommandodaten;
  }

}
