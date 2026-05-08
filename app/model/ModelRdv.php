<?php

require_once 'Model.php';

class ModelRdv {

    private $id, $creneau, $etudiant;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $creneau = NULL, $etudiant = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->creneau = $creneau;
            $this->etudiant = $etudiant;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getCreneau() {
        return $this->creneau;
    }

    public function getEtudiant() {
        return $this->etudiant;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setCreneau($creneau): void {
        $this->creneau = $creneau;
    }

    public function setEtudiant($etudiant): void {
        $this->etudiant = $etudiant;
    }

    public static function getRdvEtudiant() {
        try {
            $database = Model::getInstance();
            $query = "select creneau.creneau
              from rdv
              join personne on rdv.etudiant = personne.id
              join creneau on rdv.creneau = creneau.id
              where personne.id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $_SESSION['login_id']
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRdv");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($creneau, $etudiant) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from rdv";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into rdv values (:id, :creneau, :etudiant)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'creneau' => $creneau,
                'etudiant' => $etudiant
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

public static function getPlanningByProjet($id_projet) {
    try {
        $database = Model::getInstance();
        $query = "
            SELECT p.label AS projet_label, c.creneau, 
                   per.nom AS exam_nom, per.prenom AS exam_prenom,
                   GROUP_CONCAT(DISTINCT etu.nom, ' ', etu.prenom SEPARATOR '<br>') AS etudiants
            FROM creneau c
            JOIN projet p ON c.projet = p.id
            JOIN personne per ON c.examinateur = per.id
            LEFT JOIN rdv r ON r.creneau = c.id
            LEFT JOIN personne etu ON r.etudiant = etu.id AND etu.role_etudiant = 1
            WHERE p.id = :id_projet
            GROUP BY c.id
            ORDER BY c.creneau
        ";
        $statement = $database->prepare($query);
        $statement->execute(['id_projet' => $id_projet]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return [];
    }
}
}

?>