<?php

class Speicher {

  public function speichernPB($pb) {
    $handle = fopen("Speicher_PB.txt", "w");
    fwrite($handle, $pb->fragendatei . "-");
    fwrite($handle, $pb->email . "-");
    if (!empty($pb->antworten)) {
      foreach ($pb->antworten as $value) {
        if($value != FALSE OR empty($value)){
        fwrite($handle, $value . "-");
        }
      }
    }
    fclose($handle);
  }

  public function speichernLog($auswertung) {
    $handle = fopen("Speicher_Log.txt", "a");
    fwrite($handle, date("d-m-Y h:i", time()) . " ");
    fwrite($handle, $auswertung . "\n" . "-");
    fclose($handle);
  }

  public function laden() {
    $handle = fopen("Speicher_PB.txt", "r");
    $laden = fread($handle, 5000);
    $daten = explode('-', $laden);
    fclose($handle);

    return $daten;
  }
}
