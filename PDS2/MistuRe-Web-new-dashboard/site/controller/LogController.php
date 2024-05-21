<?php

if ($_SERVER["REQUEST_METHOD"] === "GET") {
  require_once(__DIR__ . "/../dao/LogDAO.php");
  require_once(__DIR__ . "/../dao/SubstanciaDAO.php");
  require_once(__DIR__ . "/../service/LogService.php");
  require_once(__DIR__ . "/../data-contract/LogDC.php");
  require_once(__DIR__ . "/../dao/NomeComercialDAO.php");

  if (array_key_exists("filter", $_GET)) {
    $endDate = isset($_GET["end"]) ? $_GET["end"] : null;
    $result = isset($_GET["result"]) ? $_GET["result"] : null;
    $startDate = isset($_GET["start"]) ? $_GET["start"] : null;

    $logs = LogDAO::read(array("getByPeriod", $startDate, $endDate, $result));
    $dictCount = array();

    $orderedValues = LogService::getMixturesByCountRanking($logs);

    echo json_encode($orderedValues);
  }
}
