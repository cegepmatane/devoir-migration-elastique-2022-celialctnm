<?php
require_once("Agenda.php");
require_once("AgendaSQL.php");

class Accesseur
{
  public static $baseDeDonnees = null;

  public static function initialiser()
  {
    $base = 'app-agenda';
    $hote = 'app-agenda.cyqr3vaxddvp.us-east-1.rds.amazonaws.com';
    $usager = 'celia';
    $motDePasse = 'Haricot25**';
    $nomDeSourceDeDonnees = 'mysql:dbname=' . $base . ';host=' . $hote;
    AgendaDAO::$baseDeDonnees = new PDO($nomDeSourceDeDonnees, $usager, $motDePasse);
    AgendaDAO::$baseDeDonnees->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}

class AgendaDao extends Accesseur implements AgendaSQL
{
  public static function lister()
  {
    AgendaDAO::initialiser();

    $demandeListeAgenda = AgendaDAO::$baseDeDonnees->prepare(AgendaDAO::SQL_LISTER);
    $demandeListeAgenda->execute();
    $listeAgendaObjet = $demandeListeAgenda->fetchAll(PDO::FETCH_OBJ);
    //$contratsTableau = $demandeListeAgenda->fetchAll(PDO::FETCH_ASSOC);
    $listeAgenda = null;
    foreach($listeAgendaObjet as $agendaObjet) $listeAgenda[] = new Agenda($agendaObjet);
    return $listeAgenda;
  }

  public static function chercherParId($id)
  {
    AgendaDAO::initialiser();

    $demandeAgenda = AgendaDAO::$baseDeDonnees->prepare(AgendaDAO::SQL_CHERCHER_PAR_ID);
    $demandeAgenda->bindParam(':id', $id, PDO::PARAM_INT);
    $demandeAgenda->execute();
    $agendaObjet = $demandeAgenda->fetchAll(PDO::FETCH_OBJ)[0];
    //$contrat = $demandeAgenda->fetch(PDO::FETCH_ASSOC);
    return new Agenda($agendaObjet);
  }

  public static function ajouter($agenda)
  {
    AgendaDAO::initialiser();

    $demandeAjoutAgenda = AgendaDAO::$baseDeDonnees->prepare(AgendaDAO::SQL_AJOUTER);
    $demandeAjoutAgenda->bindValue(':matiere', $agenda->matiere, PDO::PARAM_STR);
    $demandeAjoutAgenda->bindValue(':type', $agenda->type, PDO::PARAM_STR);
    $demandeAjoutAgenda->bindValue(':date', $agenda->date, PDO::PARAM_STR);
    $demandeAjoutAgenda->bindValue(':description', $agenda->description, PDO::PARAM_STR);
    $demandeAjoutAgenda->bindValue(':duree', $agenda->duree, PDO::PARAM_INT);
    $demandeAjoutAgenda->execute();
    return AgendaDAO::$baseDeDonnees->lastInsertId();
  }

   public static function modifier($agenda)
      {
        AgendaDao::initialiser();
              error_log(print_r($agenda));
            $demandeAjoutAgenda = AgendaDao::$baseDeDonnees->prepare(AgendaDao::SQL_MODIFIER);
            $demandeAjoutAgenda->bindValue(':matiere', $agenda->matiere, PDO::PARAM_STR);
            $demandeAjoutAgenda->bindValue(':type', $agenda->type, PDO::PARAM_STR);
            $demandeAjoutAgenda->bindValue(':date', $agenda->date, PDO::PARAM_STR);
            $demandeAjoutAgenda->bindValue(':description', $agenda->description, PDO::PARAM_STR);
            $demandeAjoutAgenda->bindValue(':duree', $agenda->duree, PDO::PARAM_INT);
            $demandeAjoutAgenda->bindValue(':id', $agenda->id, PDO::PARAM_INT);
            $demandeAjoutAgenda->execute();

            return AgendaDao::$baseDeDonnees;
      }

   }