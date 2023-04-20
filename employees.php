<?php

class Employee{
    private $conn;

    private $dbTable = "Employee";

    public $id;
    public $name;
    public $email;
    public $age;
    public $designation;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getEmployees()
    {
        $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->dbTable . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createEmployee()
    {
        $sqlQuery = "INSERT INTO " . $this->dbTable . "
            SET
                name = :name,
                email = :email,
                age = :age,
                designation = :designation,
                created = :created";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars($this->email);
        $this->age=htmlspecialchars($this->age);
        $this->designation=htmlspecialchars($this->designation);
        $this->created=htmlspecialchars($this->created);

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getSingleEmployee()
    {
        $sqlQuery = "
            SELECT
                id,
                name,
                email,
                age,
                designation,
                created
            FROM
            " . $this->dbTable ."
            WHERE
                age = :age";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":age", $this->age);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->age = $dataRow['age'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];
    }

    public function updateEmployee() 
    {
        $sqlQuery = "
            UPDATE 
            " . $this->dbTable . "
            SET
                name = :name,
                email = :email,
                age = :age,
                designation = :designation,
                created = :created
            WHERE
                id = :id";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteEmployee()
    {
        $sqlQuery = "DELETE FROM " . $this->dbTable ." WHERE id = :id";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}

?>