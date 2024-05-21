<?php

class LogService
{
  public static function getMixturesByCountRanking($logs)
  {
    $dictCount = array();

    foreach ($logs as $key => $log) {
      $logFilter = json_decode($log->getRequest(), true);

      if (isset($logFilter["subs"])) {
        $subs = $logFilter["subs"];
        $subIds = array();
        $subNames = array();

        foreach ($subs as $key2 => $sub) {
          $entryId = "";
          $entryName = "";

          $substance = SubstanciaDAO::read(array(("subs_id"), $sub["sub_id"], "apenas_colunas"));
          $entryId = $sub["sub_id"];
          $entryName = $substance->getPrincipioAtivo();

          if (isset($sub["nc_id"])) {
            $entryId = $entryId . ":" . $sub["nc_id"];
            $comercial = NomeComercialDAO::read(array("nc_id", $sub["nc_id"]));

            $entryName = $comercial->getDescricao() . " (" . $substance->getPrincipioAtivo() . ")";
          }

          array_push($subIds, $entryId);
          array_push($subNames, $entryName);
        }

        $slug = implode(",", $subIds);

        if (isset($dictCount[$slug])) {
          $dictCount[$slug]["count"] = $dictCount[$slug]["count"] + 1;
        } else {
          $dictCount[$slug] = array("count" => 1, "mixture" => $subNames);
        }
      }
    }

    $orderedValues = array();
    foreach ($dictCount as $key => $entry) {
      array_push($orderedValues, $dictCount[$key]);
    }

    usort($orderedValues, function ($item1, $item2) {
      return $item2["count"] <=> $item1["count"]; //desc ordering
    });

    return $orderedValues;
  }
}
