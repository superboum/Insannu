<?php
namespace Insannu\Api\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use Insannu\Api\Model\StudentFactory;
use Insannu\Api\Model\Student;

class DefaultController implements ControllerProviderInterface
{

    protected $app;
    protected $controllers;

    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $this->controllers = $app['controllers_factory'];
        $this->app = $app;
        $this->searchAction();


        return $this->controllers;
    }

    protected function searchAction() {

        $this->controllers->get('/api/search', function (Application $app) {
            return "[]";
        });

        $this->controllers->get('/api/search/{keywords}', function (Application $app, $keywords) {   
            if (strlen($keywords)>2) {
                $sf = new StudentFactory($app); 
                $sf->search($keywords);
                return $sf->getJSON();
            } else {
                return "[]";
            }

        });
    }

    protected function userAction() {
        $this->controllers->get('/user/check/{email}', function (Application $app, $email) {

        });
    }
}
