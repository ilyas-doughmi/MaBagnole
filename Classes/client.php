<?php

require_once("user.php");

class client extends user
{
    public function register()
    {
        $query = "INSERT INTO users(full_name,email,password)
        VALUES(:fullname,:email,:password)";

        $stmt = $this->pdo->prepare($query);

        $hashed_password = password_hash($this->password,PASSWORD_DEFAULT);

        try {
            $stmt->execute([
                ":fullname" => $this->fullname,
                ":email" => $this->email,
                ":password" => $hashed_password
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
