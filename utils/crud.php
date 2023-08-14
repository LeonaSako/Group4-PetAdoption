<?php
class CRUD
{
    private $connection;

    public function __construct(string $database = "be19_cr5_animal_adoption_christinaxeni", string $host = "localhost", string $user = "root", string $password = "")
    {
        $this->connection = mysqli_connect($host, $user, $password, $database);
    }

    public function select(string $table, string $columns = "*", string $condition = "")
    {
        $sql = "SELECT $columns FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }

    public function insert(string $table, string $columns, array $values)
    {
        $valuesOut = [];
        foreach ($values as $val) {
            $valuesOut[] = "'$val'";
        }
        $valuesOut = implode(",", $valuesOut);

        $sql = "INSERT INTO `$table`($columns) VALUES ($valuesOut)";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    public function selectAnimals(string $condition)
    {
        return $this->select("animal", "*", $condition);
    }

    public function countAll(string $table, string $condition = "")
    {
        $sql = "SELECT COUNT(*) AS 'count' FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $rows;
    }
    public function countAllPets(string $condition = "")
    {
        return $this->countAll("animal", $condition);
    }

    public function selectUsers(string $condition)
    {
        return $this->select("user", "*", $condition);
    }

    public function selectAdoptions(string $condition)
    {
        return $this->select("pet_adoption", "*", $condition);
    }

    public function updateAnimal($id, $name, $breed, $desc, $size, $age, $location, $vaccination, $status, $image)
    {
        $sql = "UPDATE `animal` SET `name`='$name', `breed`='$breed', `description`='$desc',`size`='$size',`age`='$age',`location`='$location',`vaccination`='$vaccination',`status`='$status'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The animal has been updated successfully");

        return $result;
    }

    public function updateAnimalStatus($id, $status)
    {
        $sql = "UPDATE `animal` SET `status`='$status' WHERE id = $id";

        mysqli_query($this->connection, $sql);
    }

    public function deleteAnimal($id)
    {
        $sql = "DELETE FROM `animal` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The animal has been deleted");
    }

    public function updateUser($id, $fname, $lname, $email, $phone, $address, $image)
    {
        $sql = "UPDATE `user` SET `first_name`='$fname', `last_name`='$lname', `email` = '$email',`phone_number`='$phone',`address`='$address'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The user information has been updated");

        return $result;
    }

    public function createAnimal(array $values)
    {
        $result = $this->insert("animal", "`name`, `breed`, `description`, `size`, `age`, `location`, `image`, `vaccination`", $values);

        $this->alert($result, "A new animal has been created");
    }

    public function createUser(array $values)
    {
        $result = $this->insert("user", "`first_name`, `last_name`, `email`, `phone_number`, `address`, `image`, `password`", $values);

        $this->alert($result, "A new user account has been created");
    }

    public function makeAdoption(array $values)
    {
        $result = $this->insert("pet_adoption", "`user_id`, `pet_id`, `adoption_date`, `adoption_fee`, `adoption_location`, `adoption_notes`", $values);

        $this->alertUser($result, "A new adoption has been submitted");
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
