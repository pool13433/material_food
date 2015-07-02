<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DbConnection {

    private static $DSN = "mysql:host=localhost;dbname=db_resturant";
    private static $USERNAME = "root";
    private static $PASSWORD = "";
    private static $OPTIONS = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    public $conn = null;
    private $RESULT_ARRAY = array();
    private $RESULT_OBJECT = null;

    public function __construct() {
        /* try {
          $this->conn = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
          } catch (PDOException $e) {
          print "Error!: " . $e->getMessage() . "<br/>";
          die();
          } */
    }

    public function open() {
        try {
            $this->conn = new PDO(self::$DSN, self::$USERNAME, self::$PASSWORD, self::$OPTIONS);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId();
    }

    public function createUserSerialCode($personStatus) {
        $pdo = new DbConnection();
        $pdo->conn = $pdo->open();
        //SELECT LPAD(CONVERT(RIGHT(`code`, 4),UNSIGNED INTEGER),4,0) as newnumber FROM `person`         
        $sql = ' SELECT RIGHT((LEFT(CURDATE(),4)+543),2) as year_ad,'; // 58
        $sql .= ' CASE status ';
        $sql .= ' WHEN 1 THEN \'EMP\'';
        $sql .= ' WHEN 2 THEN \'ONW\'';
        $sql .= ' WHEN 3 THEN \'CUS\'';
        $sql .= ' WHEN 4 THEN \'DRI\'';
        $sql .= ' WHEN 0 THEN \'GEN\'';
        $sql .= ' ELSE \'ERR\'';
        $sql .= ' END prefix_status,';
        $sql .= ' LEFT(`code`,3) as prefix,'; // DRI,EMP,CUS,ONW
        $sql .= ' LPAD(CONVERT(RIGHT(`code`, 4),UNSIGNED INTEGER)+1,4,0) as new_runnumber,';
        $sql .= ' RIGHT(`code`, 4) as runnumber';
        $sql .= ' FROM user WHERE status =:status';
        $sql .= ' ORDER BY RIGHT(`code`, 4) DESC LIMIT 0,1 ';
        //echo 'sql ::=='.$sql;

        $stmt = $pdo->conn->prepare($sql);
        $stmt->execute(array(':status' => $personStatus));
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (empty($result)) {
            return '';
        }
        $prefix = $result->prefix;
        $runnumber = $result->runnumber;
        $year_ad = $result->year_ad;
        $newrunnumber = $result->new_runnumber;
        return $prefix . $year_ad . $newrunnumber;
    }

}
