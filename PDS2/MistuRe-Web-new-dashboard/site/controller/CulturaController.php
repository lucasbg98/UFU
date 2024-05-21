<?php

if ($_SERVER["REQUEST_METHOD"]  === 'GET') {
  require_once(__DIR__ . "../../dao/CulturaDAO.php");

  if (array_key_exists("findAll", $_GET)) {
    $culturas = CulturaDAO::read(array("findAll"));

    echo json_encode($culturas);
  }

  if (array_key_exists("filterByResultOccurence", $_GET)) {
    $orderBy = isset($_GET["orderBy"]) ? $_GET["orderBy"] : "qtd";
    $resultadoStatus = isset($_GET["resultStatus"]) ? $_GET["resultStatus"] : null;
    $orderDirection = isset($_GET["orderDirection"]) ? $_GET["orderDirection"] : "desc";

    $options = array("getByResultOccurence", $orderBy, $orderDirection, $resultadoStatus);

    $culturas = CulturaDAO::read($options);

    echo json_encode($culturas);
  }
}
