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
        return $this->select("users", "*", $condition);
    }

    public function selectAdoptions(string $condition)
    {
        return $this->select("adoption", "*", $condition);
    }

    public function createPet(array $values)
    {
        $result = $this->insert("pet", "`name`, `image`, `location`, `species`, `breed`, `age`, `size`, `description`, `vaccinated`, `experienceNeeded`, `minSpace`, `behavior`, `fk_users_id`", $values);
        
        $this->alert($result, "A new pet has been created");

        header("refresh: 3; url = ../pet/listings.php");
    }

    public function updatePet($id, $name, $location, $species, $breed, $age, $size, $desc, $status, $vaccinated, $exp, $space, $behavior, $image)
    {
        $sql = "UPDATE `pet` SET `name`='$name',`location`='$location',`species`='$species',`breed`='$breed', `age`='$age', `size`='$size', `description`='$desc',
                                `available`='$status',`vaccinated`='$vaccinated',`experienceNeeded`='$exp',`minSpace`='$space',`behavior`='$behavior'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The pet has been updated successfully");

        return $result;
    }

    public function deletePet($id)
    {
        $sql = "DELETE FROM `pet` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The pet has been deleted");
    }

    public function createUser(array $values)
    {
        $result = $this->insert("users", "`role`, `firstName`, `lastName`, `email`, `phone`, `address`, `image`, `birthdate`, `space`, `experienced`, `password`", $values);

        $this->alert($result, "A new user account has been created");

        header("refresh: 2; url = ../user/dashboard.php");
    }

    public function updateUser($id, $firstname, $lastname, $address, $birthdate, $phone, $email, $space, $exp, $image)
    {
        $sql = "UPDATE `users` SET `firstName`='$firstname',`lastName`='$lastname',`address`='$address',`birthdate`='$birthdate',
                                    `phone`='$phone',`email`='$email',`space`='$space',`experienced`='$exp'";

        if (!empty($image)) {
            $sql .= ", `image`= '$image' WHERE id = $id";
        } else {
            $sql .= "WHERE id = $id";
        }

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The user information has been updated");

        return $result;
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The user has been deleted");
    }
    public function createAgency(array $values)
{
    $result = $this->insert("users", "`role`, `address`, `image`, `email`, `phone`, `password`", $values);

    $this->alert($result, "A new agency account has been created");

    header("refresh: 2; url = ../agency/dashboard.php");
}

    public function updateAgency($id, $agency, $address, $phone, $email)
    {
        $sql = "UPDATE `users` SET `agency`='$agency',`address`='$address', `email`='$email'`phone`='$phone', WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The agency information has been updated");

        return $result;
    }

    public function deleteAgency($id)
    {
        $sql = "DELETE FROM `users` WHERE id = $id";

        $result = mysqli_query($this->connection, $sql);

        $this->alert($result, "The agency has been deleted");
    }

    public function createAdoption(array $values)
    {
        $result = $this->insert("adoption", "`fk_pet_id`, `fk_users_id`, `submitionDate`, `donation`, `reason`,`adoptionDate`", $values);

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
