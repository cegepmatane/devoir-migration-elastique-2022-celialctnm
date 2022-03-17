<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once "Agenda.php";
require_once "AgendaDao.php";

$agendaJSON = file_get_contents('php://input');
$agendaObjet = json_decode( $agendaJSON );
$agenda = new Agenda($agendaObjet);

$id = AgendaDAO::ajouter($agenda);
echo $id;
