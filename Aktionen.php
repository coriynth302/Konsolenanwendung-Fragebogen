<?php

include 'Fragebogen.php';
include 'Pruefbogen.php';
include 'Systemfunktionen.php';
include 'Speicher.php';
include 'Auswertung.php';
include 'Ausgabe.php';

class Aktionen {

  public function starten() {
    
    // 1. Kommandozeile pharsen
    $kommando = Systemfunktionen::Kommandozeile_parsen_starten();

    // 2. Fragebogen laden    
    $fragen = Fragebogen::ladeFragebogen($kommando['Fragendatei']);

    // 3. Fragebogen nummerien
    $numFB = Fragebogen::nummiereFragebogen($fragen);

    // 4. Prüfungsbogen anlegen
    
    $pb = Pruefbogen::PBanlegen($kommando);

    // 5. Fragebogen ausgeben
    Ausgabe::gebeFragebogenaus($numFB);
  }

  public function antworten() {

    // 1. Kommandozeile pharsen
    $kommando = Systemfunktionen::Kommandozeile_parsen_antworten();

    // 2. PB laden
    $geladenerPB = Pruefbogen::bauePB();

    // 3. Fragebogen laden

    $fragen = Fragebogen::ladeFragebogen($geladenerPB->fragendatei);

    // 4. Fragebogen nummerien
    $numFB = Fragebogen::nummiereFragebogen($fragen);

    // 5. Antwort im Prüfungsbogen ablegen
    $meinPB = Pruefbogen::checkeAntworten($fragen, $geladenerPB, $kommando['Antwortnummer']);

    // 6. Antworten markieren
    $markierterFB = Fragebogen::markiereFB($meinPB->antworten, $numFB);

    // 7. Fragebogen ausgeben
    Ausgabe::gebeFragebogenaus($markierterFB);

    // 8. Prüfbogen speichern
    Speicher::speichernPB($meinPB);

  }

  public function auswerten() {

    // 1. Kommandozeile pharsen
    $meinPB = Pruefbogen::bauePB();

    // 2. Fragebogen laden
    $fragen = Fragebogen::ladeFragebogen($meinPB->fragendatei);

    // 4. Fragebogen nummerien
    $numFB = Fragebogen::nummiereFragebogen($fragen);

    // 5. Antworten markieren
    Fragebogen::markiereFB($meinPB->antworten, $numFB);

    // 6. Auswertung erstellen
    $auswertung = Auswertung::erstellen($meinPB->antworten, $numFB);

    // 7. Auswertung in Log speichern
    Speicher::speichernLog($auswertung);

    // 8. Auswertung ausgeben
    Ausgabe::Auswertung_ausgeben($auswertung);
  }

}
