<?php

namespace Controllers;

class Home extends \SlimController\SlimController
{

    public function indexAction()
    {
        $this->render('Views/Home', []);
    }

}
