<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 9:25 AM
 */

namespace studentform\model;




class AccountModel extends Model
{
    /**
     * @var integer Account ID
     */
    private $_id;
    /**
     * @var integer Account user name
     */
    private $_studId;
    /**
     * @var string Account Name
     */
    private $_name;
    /**
     * @var string User`s email address
     */
    private $_paper;
    /**
     * @var string Account password
     */
//    private $_password;
    /**
     * @var string Account repeat password
     */



    /**
     * @param string $_paper User`s email address
     */
    public function setPaper($_paper){
        $this->_paper = $_paper;
    }

    /**
     * @return string User`s email address
     */
    public function getPaper(){
        return $this->_paper;
    }

    /**
     * @param string $_studId Account username
     */
    public function setStudId($_studId){
        $this->_studId = $_studId;
    }

    /**
     * @return string Account username
     */
    public function getStudId(){
        return $this->_studId;
    }

    /**
     * @param string $_repeat Account repeat password
     */


    /**
     * @return string Account repeat password
     */


    /**
     * @return string Account ID
     */
//    public function getPassword()
//    {
//        return $this->_password;
//    }

    /**
     * @param string $_password Account password
     *
     * @return $this AccountModel
     */
//    public function setPassword( $_password)
//    {
//        $this->_password = $_password;
//
//        return $this;
//    }

    /**
     * @param string $_id Account id
     *
     * @return $this AccountModel
     */
    public function setID($_id)
    {
        $this->_id = $_id;

        return $this;
    }
    /**
     * @return int Account ID
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return string Account Name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $_name Account name
     *
     * @return $this AccountModel
     */
    public function setName( $_name)
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Loads account information from the database
     *
     * @param int $id Account ID
     *
     * @return $this AccountModel
     */
    public function load($sid)
    {
        // if the user has not entered a id, it will automating load a invalid password to make it login failed.
        if (!$result = $this->db->query("SELECT * FROM `account` WHERE `studentId` = '$sid';")) {
            $this->_password = ";;;;;;;;;;;;";
            return $this;
            // throw new ...
        }

        $result = $result->fetch_assoc();
        $this->_id = $result['id'];
        $this->_name = $result['name'];
        $this->_studId = sid;
        $this->_paper = $result['paper'];
        $this->_password = $result['password'];


        return $this;
    }


    /**
     * Check whether the user have entered the correct password
     * @param string $pw Account password
     * @return string hint reminder
     */
//    public function checkPassword(string $pw){
//        return $pw == $this->_password?"Login successfully!":"Login failed!";
//    }
    /**
     * Check whether the user name have been occupied or not
     * @param string $user Account user name
     * @return string hint reminder
     */
    public function checkUsername(string $stid){
        $result = $this->db->query("SELECT * FROM `account` WHERE `studentId` = '$stid';");
        if(mysqli_num_rows($result)==0)
        {
            return "OK";
        } else{
            return "StudentId has been used before!";
        }
    }

    /**
     * Saves account information to the database

     * @return $this AccountModel
     */

    public function save()
    {
        $name = $this->_name??"NULL";
        $studentId = $this->_studId??"NULL";
        $paper = $this->_paper??"NULL";
//        $password = $this->_password?? "NULL";
        if (!isset($this->_id)) {
            // New account - Perform INSERT
            if (!$result = $this->db->query("INSERT INTO `account` VALUES (NULL,'$name','$studentId','$paper');")) {
            }
            $this->_id = $this->db->insert_id;
        } else {
            // saving existing account - perform UPDATE
            if (!$result = $this->db->query("UPDATE `account` SET `name` = '$name', `studentId` = '$studentId', `paper` = '$paper'  WHERE `id` = $this->_id;")) {
                $this->_id = $this->db->client_info;
            }
        }
        return $this;
    }

}