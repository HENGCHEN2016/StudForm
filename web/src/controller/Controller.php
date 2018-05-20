<?php
/**
 * Created by PhpStorm.
 * User: jackyqiu
 * Date: 8/05/18
 * Time: 9:57 AM
 */

namespace studentform\controller;


class Controller
{
    /**
     * Generate a link URL for a named route
     *
     * @param string $route  Named route to generate the link URL for
     * @param array  $params Any parameters required for the route
     *
     * @return string  URL for the route
     */
    static function linkTo($route, $params=[])
    {
        // cheating here! What is a better way of doing this?
        $router = $GLOBALS['router'];
        return $router->generate($route, $params);
    }

//    /**
//     * This method gets called whenever a ConfirmException is thrown.
//     * Do nothing other than keep the current session
//     *
//     * Customer Error Action
//     */
//    public function errorAction() {
//        session_start();
//    }
//    /*
//     *
//     */
//    public function setSession($id, $name, $paper)
//    {
//        $_SESSION['id'] = $id;
//        $_SESSION['name'] = $name;
//        $_SESSION['paper'] = $paper;
//    }
//    /**
//     * Determines which view to display to the user based on the filename and the data needed to display on that page
//     *
//     * @param string $fileName  The name of the template file to be viewed
//     * @param null $data        Optional param for data to be sent to the view
//     * @param null $data2       Optional param for a second set of data to be sent to the view
//     */
//    public function showView($fileName, $data = null, $data2 = null)
//    {
//        $view = new View($fileName);
//        if($data == null) {
//            echo $view->addData('linkTo', function ($route, $params = []) {
//                return $this->linkTo($route, $params);
//            })->render();
//        } else if($data2 == null) {
//            echo $view->addData('data', $data)
//                ->addData('linkTo', function ($route, $params = []) {
//                    return $this->linkTo($route, $params);
//                })->render();
//        } else {
//            echo $view->addData('data', $data)->addData('data2', $data2)
//                ->addData('linkTo', function ($route, $params = []) {
//                    return $this->linkTo($route, $params);
//                })->render();
//        }
//    }
}