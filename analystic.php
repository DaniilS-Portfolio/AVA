<?php
    $_POST = json_decode(file_get_contents('php://input'), true);

    if (isset($_POST["userAgent"])) {
        AVA::UserAgent($_POST["userAgent"]);
    }

    class AVA {
        private static $host;
        private static $db;
        private static $login;
        private static $password;
        private static $pdo;

        public static function Start()
        {
            $ini = parse_ini_file("config.ini");
            $host = $ini["host"];
            $db = $ini["db"];
            $login = $ini["login"];
            $password = $ini["password"];
            AVA::$pdo = new PDO("mysql:dbname=$db;host=$host", $login, $password);
            return AVA::$pdo;
        }
        public static function UserAgent($usrAg)
        {
            AVA::CheckUATable();
            $data = json_decode($usrAg);
            $data->location->ip = $_SERVER["REMOTE_ADDR"];
            AVA::WriteData("AVA_userAgent", json_encode(json_encode($data)));
        }
        public static function GetData()
        {            
            $sql = "SELECT `data` FROM AVA_userAgent";
            $pdo = AVA::Start();
            $result = $pdo->query($sql);
            $result = $result->fetchAll();
            for ($i = 0; $i < count($result); $i++)
            {
                echo "<hr><pre>";
                var_dump(json_decode($result[$i]["data"]));
                echo "</pre>";
            }
        }
        private static function CheckUATable()
        {
            $sql = "CREATE TABLE AVA_userAgent
            (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `data` JSON,
                `time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );";
            $pdo = AVA::Start();
            $pdo->query($sql);
        }
        private static function WriteData($table, $data)
        {
            $sql = "INSERT INTO $table (`data`) VALUES ($data)";
            $pdo = AVA::Start();
            $pdo->query($sql);
        }
    }
?>