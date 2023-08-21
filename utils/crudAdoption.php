<?php
class CRUD_ADOPTION
{
    private $connection;

    public function __construct(string $database = "pet_adoption", string $host = "localhost", string $user = "root", string $password = "")
    {
        $this->connection = mysqli_connect($host, $user, $password, $database);
    }

    public function select(string $table, string $columns = "*", string $condition)
    {
        $sql = "SELECT $columns FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function selectAdoptions(string $condition)
    {
        return $this->select("adoption", "*", $condition);
    }

    public function selectAgencyAdoptions(string $condition)
    {
        return $this->select("adoption INNER JOIN pet ON adoption.fk_pet_id = pet.id", "*", $condition);
   
    }

    public function selectAdoptionsAndAgencyPets(string $condition)
    {
        $table = "`adoption` a 
        RIGHT JOIN `pet` p ON a.fk_pet_id = p.id 
        LEFT JOIN `users` u ON a.fk_adoptee_id = u.id ";

        $columns = "p.id as petId, 
        p.name as pname, 
        p.species as species, 
        u.id as userId, 
        u.firstName as firstname, 
        u.lastName as lastname, 
        a.id as adopId, 
        a.adopStatus as adopStatus, 
        a.adoptionDate as adoptionDate , 
        a.submitionDate as submitionDate, 
        a.reason as reason, 
        a.donation as donation ,
        p.fk_users_id as agency ";

        return $this->select($table, $columns, $condition);
    }

    public function insert(string $table, string $columns, array $values)
    {
        $valuesOut = [];
        foreach ($values as $val) {
            if (is_numeric($val)) {
                $valuesOut[] = "$val";
            } else {
                $valuesOut[] = "'$val'";
            }
        }
        $valuesOut = implode(",", $valuesOut);

        $sql = "INSERT INTO `$table`($columns) VALUES ($valuesOut)";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function createAdoption(array $values)
    {
        $result = $this->insert("adoption", "`fk_pet_id`, `fk_adoptee_id`, `submitionDate`, `donation`, `reason`,`adoptionDate`", $values);

        $this->alertUser($result, "A new adoption has been submitted");
    }

    public function updateAdoptionStatus($id, $status, $date)
    {
        $sql = "UPDATE `adoption` SET `adopStatus`='$status',`adoptionDate`='$date' WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The adoption status has been updated");

        return $result;
    }

    public function alertUser($result, string $message)
    {
        if ($result) {
            echo "
            <div class='alert alert-success'>
               <p>{$message}</p>
            </div>";
        } else {
            echo "
            <div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
            </div>";
        }
    }
    public function alert($result, string $message)
    {
        if ($result) {
            echo "
            <div class='alert alert-success'>
               <p>{$message}</p>
            </div>";
        } else {
            echo "
            <div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
            </div>";
        }
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }
}
