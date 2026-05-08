<?php

require_once 'Model.php';

class ModelPersonne {

    private $id, $nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL,
            $role_responsable = NULL, $role_examinateur = NULL, $role_etudiant = NULL,
            $login = NULL, $password = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->role_responsable = $role_responsable;
            $this->role_examinateur = $role_examinateur;
            $this->role_etudiant = $role_etudiant;
            $this->login = $login;
            $this->password = $password;
        }
    }

//getters et setters à faire
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getRole_responsable() {
        return $this->role_responsable;
    }

    public function getRole_examinateur() {
        return $this->role_examinateur;
    }

    public function getRole_etudiant() {
        return $this->role_etudiant;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setPrenom($prenom): void {
        $this->prenom = $prenom;
    }

    public function setRole_responsable($role_responsable): void {
        $this->role_responsable = $role_responsable;
    }

    public function setRole_examinateur($role_examinateur): void {
        $this->role_examinateur = $role_examinateur;
    }

    public function setRole_etudiant($role_etudiant): void {
        $this->role_etudiant = $role_etudiant;
    }

    public function setLogin($login): void {
        $this->login = $login;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public static function loginPersonne($login, $password) {
        try {
            $database = Model::getInstance();
            $query = "select *
                  from personne 
                  where login = :login 
                  and password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPersonne");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $role_responsable, $role_examinateur, $role_etudiant, $login, $password) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from personne";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into personne values (:id, :nom, :prenom, :role_responsable, :role_examinateur, :role_etudiant, :login, :password)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'role_responsable' => $role_responsable,
                'role_examinateur' => $role_examinateur,
                'role_etudiant' => $role_etudiant,
                'login' => $login,
                'password' => $password
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getAllExaminateurs() {
        $database = Model::getInstance();
        $sql = "SELECT nom, prenom FROM personne WHERE role_examinateur = 1 ORDER BY nom, prenom";
        $stmt = $database->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ajouterExaminateur($nom, $prenom) {
        $database = Model::getInstance();
        $sql_check = "SELECT * FROM personne WHERE nom = :nom AND prenom = :prenom";
        $stmt_check = $database->prepare($sql_check);
        $stmt_check->execute(['nom' => $nom, 'prenom' => $prenom]);
        $personne = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($personne) {
            $sql_update = "UPDATE personne SET role_examinateur = 1 WHERE id = :id";
            $stmt_update = $database->prepare($sql_update);
            $stmt_update->execute(['id' => $personne['id']]);
        } else {
            $sql_max_id = "SELECT MAX(id) AS max_id FROM personne";
            $stmt_max = $database->query($sql_max_id);
            $row = $stmt_max->fetch(PDO::FETCH_ASSOC);
            $new_id = $row['max_id'] + 1;

            $login = strtolower($nom); // Login par défaut : nom en minuscules
            $password = 'secret';

            $sql_insert = "INSERT INTO personne (id, nom, prenom, role_examinateur, role_responsable, role_etudiant, login, password)
                   VALUES (:id, :nom, :prenom, 1, 0, 0, :login, :password)";
            $stmt_insert = $database->prepare($sql_insert);
            $stmt_insert->execute([
                'id' => $new_id,
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'password' => $password
            ]);
            return [
                'id' => $new_id,
                'nom' => $nom,
                'prenom' => $prenom
            ];
        }
    }

    public static function getById($id) {
        $database = Model::getInstance();
        $sql = "SELECT * FROM personne WHERE id = :id";
        $stmt = $database->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>