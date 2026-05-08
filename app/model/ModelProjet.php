<?php

require_once 'Model.php';

class ModelProjet {

    private $id, $label, $responsable, $groupe;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $label = NULL, $responsable = NULL, $groupe = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->responsable = $responsable;
            $this->groupe = $groupe;
        }
    }

//getters et setters à faire
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getResponsable() {
        return $this->responsable;
    }

    public function getGroupe() {
        return $this->groupe;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setResponsable($responsable): void {
        $this->responsable = $responsable;
    }

    public function setGroupe($groupe): void {
        $this->groupe = $groupe;
    }

    public static function getProjetExaminateur() {
        try {
            $database = Model::getInstance();
            $query = "select projet.label, projet.responsable, projet.groupe
              from creneau
              join personne on creneau.examinateur = personne.id
              join projet on creneau.projet = projet.id
              where personne.id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['login_id']
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProjet");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAllNames() {
        try {
            $database = Model::getInstance();
            $query = "select label from projet";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function ajouterProjet($label, $groupe, $id_responsable) {
        $database = Model::getInstance();

        $sql_max = "SELECT MAX(id) AS max_id FROM projet";
        $stmt_max = $database->query($sql_max);
        $row = $stmt_max->fetch(PDO::FETCH_ASSOC);
        $new_id = $row['max_id'] + 1;

        $sql = "INSERT INTO projet (id, label, groupe, responsable) VALUES (:id, :label, :groupe, :responsable)";
        $req = $database->prepare($sql);
        $req->execute([
            'id' => $new_id,
            'label' => $label,
            'groupe' => $groupe,
            'responsable' => $id_responsable
        ]);
    }

    public static function getProjetByLabelAndResponsable($label, $responsable_id) {
        $sql = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
            FROM projet
            JOIN personne ON projet.responsable = personne.id
            WHERE projet.label = :label AND responsable = :responsable
            ORDER BY projet.id DESC LIMIT 1";

        $req = Model::getInstance()->prepare($sql);
        $req->execute([
            'label' => $label,
            'responsable' => $responsable_id
        ]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAllNamesWithId() {
        try {
            $database = Model::getInstance();
            $query = "select id, label from projet";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getProjetsByResponsable($id) {
        try {
            $database = Model::getInstance();
            $query = "SELECT projet.id, projet.label, projet.groupe, personne.nom, personne.prenom
                  FROM projet
                  JOIN personne ON projet.responsable = personne.id
                  WHERE responsable = :id";
            $statement = $database->prepare($query);
            $statement->execute(['id' => $id]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur getProjetsByResponsable : " . $e->getMessage());
        }
    }
}

?>
