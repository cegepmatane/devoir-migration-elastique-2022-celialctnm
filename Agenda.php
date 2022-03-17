<?php
class Agenda implements JsonSerializable
{
  public static $filtres =
    array(
      'id' => FILTER_VALIDATE_INT,
      'matiere' => FILTER_SANITIZE_ENCODED,
      'type' => FILTER_SANITIZE_ENCODED,
      'date' => FILTER_SANITIZE_ENCODED,
      'description' => FILTER_SANITIZE_ENCODED,
      'duree' => FILTER_VALIDATE_INT
    );

  protected $id;
  protected $matiere;
  protected $type;
  protected $date;
  protected $description;
  protected $duree;

  public function __construct($agendaObjet)
  {
    $tableau = filter_var_array((array) $agendaObjet, Agenda::$filtres);
    $this->id = $tableau['id'];
    $this->matiere = $tableau['matiere'];
    $this->type = $tableau['type'];
    $this->date = $tableau['date'];
    $this->description = $tableau['description'];
    $this->duree = $tableau['duree'];
  }

  public function __set($propriete, $valeur)
  {
    switch($propriete)
    {
      case 'id':
        $this->id = $valeur;
        break;
      case 'matiere':
        $this->matiere = $valeur;
        break;
      case 'type':
        $this->type = $valeur;
        break;
      case 'date':
        $this->date = $valeur;
        break;
      case 'description':
        $this->description = $valeur;
        break;
      case 'duree':
              $this->duree = $valeur;
              break;

    }
  }

  public function __get($propriete)
  {
    $self = get_object_vars($this);
    return $self[$propriete];
  }

  public function jsonSerialize()
  {
    //Define the fields we need
    return array(
      "id"=>$this->id,
      "matiere"=>$this->matiere,
      "type"=>$this->type,
      "date"=>$this->date,
      "description"=>$this->description,
      "duree"=>$this->duree,
    );
  }
}
