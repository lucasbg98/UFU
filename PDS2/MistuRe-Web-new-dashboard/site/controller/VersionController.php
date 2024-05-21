<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  http_response_code(200);

  $allowedAppVersion = "1.0.0";
  $urlToUpdateApp = "http://www.google.com.br";
  $res = array("appVersion" => $allowedAppVersion, "serverDate" => new DateTime(), "urlToUpdateApp" => $urlToUpdateApp);

  echo json_encode($res);
}
