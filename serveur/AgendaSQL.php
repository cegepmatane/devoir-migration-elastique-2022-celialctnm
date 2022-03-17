<?php
interface AgendaSQL
{
  public const SQL_LISTER          = "SELECT * FROM agenda1;";
  public const SQL_CHERCHER_PAR_ID = "SELECT * FROM agenda1 WHERE id = :id;";
  public const SQL_AJOUTER         = "INSERT INTO agenda1 (matiere, type, date, description, duree) VALUES (:matiere, :type, :date, :description, :duree);";
  public const SQL_MODIFIER        = "UPDATE agenda1 SET matiere = :matiere, type = :type, date = :date, description = :description, duree = :duree  WHERE id = :id;";
}