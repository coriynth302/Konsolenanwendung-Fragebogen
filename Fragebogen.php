<?php

include 'Reader.php';

class Fragebogen {

  public $fragen = array();

  function ladeFragebogen($kommando) {

    $reader = new Reader();
    $fragen = $reader->holeFragen($kommando);

    foreach ($fragen as $frage) {
      foreach ($frage->antworten as $antwort) {
        if (strpos($antwort, "*") !== FALSE) {
          $antwort = substr($antwort, 2);
          $antworten[] = new AnwortMoeglichkeiten($antwort, TRUE, NULL);
        } else {
          if ($antwort != FALSE) {
            $antworten[] = new AnwortMoeglichkeiten($antwort, FALSE, NULL);
          }
        }
      }
      $antworten[] = new AnwortMoeglichkeiten("Keine Ahnung", FALSE, NULL); 
      $this->fragen[] = new Fragen($antworten, $frage->fragen, NULL);
      unset($antworten);
    }
    return $this->fragen;
  }

  function nummiereFragebogen($fragen) {

    $indexFrage = 0;
    $indexAnt = 0;
    foreach ($fragen as $frage) {
      $indexFrage ++;
      $frage->nummer = "$indexFrage";
      foreach ($frage->antworten as $antwort) {
        $indexAnt ++;
        $antwort->nummer = "$indexAnt";
      }
    }

    return $fragen;
  }

  public function markiereFB($antworten, $fragen) {

    foreach ($antworten as $value) {

      foreach ($fragen as $frage) {
        foreach ($frage->antworten as $antwort) {
          if ($antwort->nummer == $value) {
            $antwort->text = $antwort->text . "  ** FRAGE $antwort->nummer BEANTWORTET**";
          }
        }
      }
    }
    return $fragen;
  }

}

class Fragen {

  public $antworten;
  public $frage = '';
  public $nummer;

  public function __construct($antwort, $frage, $nummer) {
    $this->antworten = $antwort;
    $this->frage = $frage;
    $this->nummer = $nummer;
  }

}

class AnwortMoeglichkeiten {

  public $text = '';
  public $antwort;
  public $nummer;

  public function __construct($text, $antwort, $nummer) {
    $this->text = $text;
    $this->antwort = $antwort;
    $this->nummer = $nummer;
  }

}
