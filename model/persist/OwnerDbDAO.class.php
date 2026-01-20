<?php

require_once "model/persist/ConnectDb.class.php";

class OwnerDbDAO {

    private static $instance = NULL;
    private $connect;

    public function __construct() {
        $this->connect = (new ConnectDb())->getConnection();
    }

    public static function getInstance(): OwnerDbDAO {
        if (self::$instance == NULL) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function modify($owner): bool {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return FALSE;
        };

        try {
            $sql = <<<SQL
                UPDATE propietaris SET email=:email,movil=:movil
                        WHERE ID=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindValue(":email", $owner->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":movil", $owner->getMovil(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $owner->getId(), PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount()) {
                return TRUE;
            } else {
                return FALSE;
            }

        } catch (PDOException $e) {
            return FALSE;
        }
    }

    public function listAll(): array {
        $result = array();

        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return $result;
        };

        try {
            $sql = <<<SQL
                SELECT id,nom,email,movil FROM propietaris;
            SQL;

            $result = $this->connect->query($sql);

            $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Owner');

            return $result->fetchAll();
        } catch (PDOException $e) {
            return $result;
        }

        return $result;
    }

    public function searchById($id) {
        if ($this->connect == NULL) {
            $_SESSION['error'] = "Unable to connect to database";
            return NULL;
        };

        try {
            $sql = <<<SQL
                SELECT id,nom,email,movil FROM propietaris WHERE id=:id;
            SQL;

            $stmt = $this->connect->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            if ($stmt->rowCount()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Owner');
                return $stmt->fetch();
            } else {
                return NULL;
            }
        } catch (PDOException $e) {
            return NULL;
        }
    }

}
