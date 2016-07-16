<?php
date_default_timezone_set('UTC');
include("lib/check-generator.php");

$CHK = new CheckGenerator;


$check['logo'] = "";
$check['from_name'] = "Your Name";

$check['from_address1'] = "1234 E Main St";
$check['from_address2'] = "Portland, OR 97214";

$check['routing_number'] = "123000220";
$check['account_number'] = "123456789012";
$check['bank_1'] = "US Bank";
$check['bank_2'] = "1225 SE Cesar E Chavez Blvd";
$check['bank_3'] = "Portland, OR 97214-4371";
$check['bank_4'] = "(503) 275-4550";

$check['signature'] = "";

$check['pay_to'] = "";
$check['amount'] = '';
$check['date'] = "";
$check['memo'] = "";

// 3 checks per page

$check['check_number'] = 1000;
$CHK->AddCheck($check);

$check['check_number']++;
$CHK->AddCheck($check);

$check['check_number']++;
$CHK->AddCheck($check);



if(array_key_exists('REMOTE_ADDR', $_SERVER)) {
  // Called from a browser
  header('Content-Type: application/octet-stream', false);
  header('Content-Type: application/pdf', false);
  $CHK->PrintChecks();
} else {
  // Called from the command line
  ob_start();
  $CHK->PrintChecks();
  $pdf = ob_get_clean();
  file_put_contents('checks.pdf', $pdf);
  echo "Saved to file: checks.pdf\n";
}

