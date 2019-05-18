<?php
/*
Page Name: 404
*/

namespace Templates\MiPHP\Page;

use Templates\MiPHP\Template;

if($_SERVER['PHP_SELF'] != '/index.php')
    header('Location: /');

class ThreeZeroThree extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->mi->errorPage(array('404', 'Not Found'));
    }
}