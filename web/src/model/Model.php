<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 8:33 AM
 */

namespace studentform\model;

use mysqli;

class Model
{

    protected $db;

    const DB_HOST = 'mysql';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_NAME = 'StudentForm';


    /**
     * (tested)
     * Model constructor
     */
    function __construct()
    {
        $this->db = new mysqli(
            Model::DB_HOST,
            Model::DB_USER,
            Model::DB_PASS
        //            Model::DB_NAME
        );

        if (!$this->db) {
            // can't connect to MYSQL???
            // handle it...
            // e.g. throw new someException($this->db->connect_error, $this->db->connect_errno);
        }

        //----------------------------------------------------------------------------
        // This is to make our life easier
        // Create your database and populate it with sample data
        $this->db->query("CREATE DATABASE IF NOT EXISTS " . Model::DB_NAME . ";");

        if (!$this->db->select_db(Model::DB_NAME)) {
            // somethings not right.. handle it
            error_log("Mysql database not available!", 0);
        }

        $result = $this->db->query("SHOW TABLES LIKE 'account';");

        if ($result->num_rows == 0) {
            // table doesn't exist
            // create it and populate with sample data

            $result = $this->db->query(
                "CREATE TABLE `account` (
                                          `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
                                          `name` varchar(256) DEFAULT NULL,
                                          `studentId` varchar(256) DEFAULT NULL,
                                          `paper` varchar(256) DEFAULT NULL,
                                          PRIMARY KEY (`id`) );"
            );

            if (!$result) {
                // handle appropriately
                error_log("Failed creating table account", 0);
            }

            if (!$this->db->query(
                "INSERT INTO `account` VALUES (NULL,'Bob', '111','123.123'), (NULL,'Mary', '112','123.111');"
            )) {
                // handle appropriately
                error_log("Failed creating sample data!", 0);
            }
        }
    }

}