<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 19/05/18
 * Time: 1:19 PM
 */

namespace studentform\model;


class AccountCollectionModel extends Model
{
    private $_accountIds; // user account id

    private $_N;
    private $_username;

    function __construct()
    {
        parent::__construct();
        if (!$result = $this->db->query("SELECT `id` FROM `account`;")) {
            // throw new ...
        }
        $this->_accountIds = array_column($result->fetch_all(), 0);
        $this->_N = $result->num_rows;
    }

    /**
     * Get account collection
     *
     * @return Generator|AccountModel[] Accounts
     */
    public function getAccounts()
    {
        foreach ($this->_accountIds as $id) {
            // Use a generator to save on memory/resources
            // load accounts from DB one at a time only when required
            yield (new AccountModel())->load($id);
        }
    }

}