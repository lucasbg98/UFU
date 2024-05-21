<?php

require_once(__DIR__ . "/../dao/PerfilDAO.php");

class PerfilService
{
  public static function getProfiles(?string $origin = "app")
  {
    $profiles = PerfilDAO::read(array("getAll", $origin));

    return $profiles;
  }
}
