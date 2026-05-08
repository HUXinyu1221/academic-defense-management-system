<?php

require_once 'Model.php';

class ModelCreneau {

    private $id, $label, $examinateur, $creneau;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $label = NULL, $examinateur = NULL, $creneau = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->label = $label;
            $this->examinateur = $examinateur;
            $this->creneau = $creneau;
        }
    }

//getters et setters à faire
    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getExaminateur() {
        return $this->examinateur;
    }

    public function getCreneau() {
        return $this->creneau;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setLabel($label): void {
        $this->label = $label;
    }

    public function setExaminateur($examinateur): void {
        $this->examinateur = $examinateur;
    }

    public function setCreneau($creneau): void {
        $this->creneau = $creneau;
    }

    public static function getCreneauExaminateur() {
        try {
            $database = Model::getInstance();
            $query = "select projet.label, creneau.creneau
              from creneau
              join personne on creneau.examinateur = personne.id
              join projet on creneau.projet = projet.id
              where personne.id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['login_id']
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getCreneauProjet($project) {
        try {
            $database = Model::getInstance();
            $query = "select creneau.id, creneau.creneau
              from creneau
              join projet on creneau.projet = projet.id
              where projet.id = :project";
            $statement = $database->prepare($query);
            $statement->execute([
                'project' => $project
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getCreneauExaminateurProjet($project_name) {
        try {
            $database = Model::getInstance();
            $query = "select projet.label, creneau.creneau
              from creneau
              join personne on creneau.examinateur = personne.id
              join projet on creneau.projet = projet.id
              where personne.id = :id and projet.label = :project_name";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['login_id'],
                'project_name' => $project_name
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getExaminateursByProjet($id_projet) {
        try {
            $database = Model::getInstance();
            $query = "SELECT p.nom, p.prenom, c.creneau
                  FROM creneau c
                  JOIN personne p ON c.examinateur = p.id
                  WHERE c.projet = :id_projet";
            $statement = $database->prepare($query);
            $statement->execute(['id_projet' => $id_projet]);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return [];
        }
    }

    public static function getCreneauOnlyExaminateur() {
        try {
            $database = Model::getInstance();
            $query = "select creneau.creneau
              from creneau
              join personne on creneau.examinateur = personne.id
              join projet on creneau.projet = projet.id
              where personne.id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['login_id']
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCreneau");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($projet, $examinateur, $creneau) {
        try {
            $database = Model::getInstance();

            $query = "select max(id) from creneau";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into creneau values (:id, :projet, :examinateur, :creneau)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'projet' => $projet,
                'examinateur' => $examinateur,
                'creneau' => $creneau
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}

?>
