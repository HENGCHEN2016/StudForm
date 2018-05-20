<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 10:04 AM
 */

namespace studentform\controller;

use studentform\model\AccountCollectionModel;
use studentform\model\AccountModel;
use studentform\view\View;


class AccountController extends Controller
{

    public function indexAction()
    {
        $collection = new AccountCollectionModel();
        $accounts = $collection->getAccounts();
        $view = new View('accountIndex');
        echo $view->addData('accounts', $accounts)
            ->addData(
                'linkTo', function ($route,$params=[]) {
                return $this->linkTo($route, $params);
            }
            )
            ->render();
    }

    public function signupAction(){
        $view = new View('accountSignup');
        echo $view
            ->addData(
                'linkTo', function ($route,$params=[]) {
                return $this->linkTo($route, $params);
            }
            )
            ->render();
    }

    public function createAction()
    {
        $account = new AccountModel();
        $name = (string)$_POST['name'];
        $studId = (string)$_POST['sid'];
        $paper = (string)$_POST['paper'];
//        $password = (string)$_POST['password'];
        $account->setName($name);
        $account->setStudId($studId);
        $account->setPaper($paper);
//        $account->setPassword($password);

        $account->save();
        $username = $account->getStudId();
        $view = new View('accountCreated');
        echo $view->addData('studId', $studId)
            ->addData(
                'linkTo', function ($route,$params=[]) {
                return $this->linkTo($route, $params);
            }
            )
            ->render();
    }

//    public function readAction(){
//        $view = new View('powerpoint');
//        echo $view
//            ->addData(
//                'linkTo', function ($route,$params=[]) {
//                return $this->linkTo($route, $params);
//            }
//            )
//            ->render();
//    }
}