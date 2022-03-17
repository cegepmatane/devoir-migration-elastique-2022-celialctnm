<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: application/json; charset=utf-8');

require_once "Agenda.php";
require_once("AgendaDao.php");

$agenda = new Agenda($_GET);
$agenda = AgendaDao::chercherParId($agenda->id);
echo json_encode($agenda);
