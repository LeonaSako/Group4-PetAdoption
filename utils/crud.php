<?php
class CRUD
{
    private $connection;

    public function __construct(string $database = "pet_adoption", string $host = "localhost", string $user = "root", string $password = "")
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

    public function selectPets(string $condition)
    {
        return $this->select("pet", "*", $condition);
    }

    public function selectUsers(string $condition)
    {
        return $this->select("user", "*", $condition);
    }
    public function createPet(array $values)
    {
        $result = $this->insert("pet", "`name`, `image`, `location`, `species`, `breed`, `age`, `size`, `description`, `available`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`", $values);

        $this->alert($result, "A new pet has been created");
    }

    public function createUser(array $values)
    {
        $result = $this->insert("user", "`role`, `firstName`, `lastName`, `email`, `phone`, `address`, `image`, `birthdate`, `space`, `experienced`, `password`", $values);

        $this->alert($result, "A new user account has been created");
    }

    public function createAgency(array $values)
    {
        $result = $this->insert("user", "`role`, `agency`, `address`, `email`, `phone`, `password`", $values);

        $this->alert($result, "A new agency account has been created");
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
