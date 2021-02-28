<?php
namespace Mark\Models;

class DatabaseClass
{
    private $connection = null;

    public function __construct($dbhost, $dbname, $username, $password)
    {
        try {
            $this->connection = @new \mysqli($dbhost, $username, $password, $dbname);
            if (mysqli_connect_errno()) {
                throw new \Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function addTask($user, $mail, $task, $status)
    {
        try {
            $query = "INSERT INTO tasks (`user`, `mail`, `task`, `status`) VALUES (?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssss", $user, $mail, $task, $status);
            $stmt->execute();
            $id = $stmt->insert_id;
            $stmt->close();
            return $id;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getTask($number)
    {
        $begin = (int)$number;
        $query = "SELECT id, user, mail, status, task FROM tasks WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $begin);
            $stmt->execute();
            $stmt->bind_result($r1, $r2, $r3, $r4, $r5);
            $stmt->fetch();
            $stmt->close();
            return ['id' => $r1, 'user' => $r2, 'mail' => $r3, 'status' => $r4, 'task' => $r5];
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function selectTask($id, $sort)
    {
        switch ($sort) {
            case 1:
                $replace = 'user DESC';
                break;
            case 2:
                $replace = 'mail';
                break;
            case 3:
                $replace = 'mail DESC';
                break;
            case 4:
                $replace = 'status';
                break;
            default:
                $replace = 'user';
                break;
        }
        $query = str_replace('&', $replace, "SELECT id, user, mail, status, task FROM tasks ORDER by & LIMIT ?,3");
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($r1, $r2, $r3, $r4, $r5);
            $arr = [];
            while ($stmt->fetch()) {
                array_push($arr, ['id' => $r1, 'user' => $r2, 'mail' => $r3, 'status' => $r4, 'task' => $r5]);
            }
            $stmt->close();

            return $arr;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getNumberTasks()
    {
        return intval(ceil($this->connection->query("SELECT COUNT(*) AS count FROM tasks")->fetch_assoc()['count'] / 3));
    }

    public function replaceTasks($number, $status, $task = '')
    {
        try {
            $n = (int)$number;
            if ($status === 'changeStatus') {
                $query = "UPDATE tasks SET status = ?, task = ? WHERE id = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("ssi", $status, $task, $n);
            } else {
                $query = "UPDATE tasks SET status = ? WHERE id = ?";
                $stmt = $this->connection->prepare($query);
                $stmt->bind_param("si", $status, $n);
            }
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getToken($login, $passw)
    {
        try {
            $query = "SELECT token FROM tokens WHERE login = ? AND passw = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ss", $login, $passw);
            $stmt->execute();
            $stmt->bind_result($r1);
            $stmt->fetch();
            $stmt->close();
            if ($r1 !== null) return $r1;
            $token = md5(strval(rand(0, 50000)));
            $query = "INSERT INTO `tokens` (`token`,`login`,`passw`) VALUES (?,?, ?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param('sss', $token, $login, $passw);
            $stmt->execute();
            return $token;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkToken($token)
    {
        try {
            $query = "SELECT id FROM tokens WHERE token = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->bind_result($r1);
            $stmt->fetch();
            $stmt->close();
            if ($r1 === null) return false;
            return $r1;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteToken($token)
    {
        try {
            $query = "DELETE FROM tokens WHERE token = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $stmt->close();
            return true;
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}