<?php

class DB {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=CoursPHP;', 'root', '11Dennis');
                self::$instance->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);    // les noms de champs seront TOUJOURS en minuscules
                self::$instance->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);    // les erreurs SQL lanceront des exceptions PDO
                self::$instance->exec("SET NAMES 'utf8'");    // force échange de données en UTF-8
            } catch (PDOException $e) {
                die("Erreur MySQL: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private function __construct() {}

    public static function __callStatic($name, $args) {
        $bdd = self::getInstance();
        try {
            // return $bdd->$name($args);
            return call_user_func_array(array($bdd, $name), $args);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}