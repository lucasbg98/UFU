<?php

require_once(__DIR__ . "/../model/Log.php");

class LogDC
{
  public int $id;
  public string $request;
  public string $response;
  public int $origin;
  public DateTime $created_at;

  public function __construct(Log $log)
  {
    $this->id = $log->getId();
    $this->request = $log->getRequest();
    $this->response = $log->getResponse();
    $this->created_at = $log->getCriadoEm();
  }
}
