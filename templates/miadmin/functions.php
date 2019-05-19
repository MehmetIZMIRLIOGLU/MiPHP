<?php
/**
 * Example Templates - MiPHP Admin
 */

namespace Templates\MiAdmin;

use Extensions\Mi\Account;
use Extensions\Mi\DatabasePDO;

if($_SERVER['PHP_SELF'] != '/index.php')
    header('Location: /');

class Template extends \Extensions\Mi\FrontEnd\Template
{
    public $userC;

    public function __construct()
    {
        $this->dir = __DIR__ . '/';
        parent::__construct();
        $this->userC = new Account();
    }

    public function database()
    {
        $db = new DatabasePDO();
        $db = $db->connectDatabase();
        $this->db = $db[0];
    }

    public function baseUrl($file = '')
    {
        return $this->assetsUri . $file;
    }
}

$Template = new Template();

// Pages System

$s = $this->mi->s;

// User Information

$user = $Template->userC->start();

$this->getTemplateClasses($Template->phpDir);

if($user != false) {
    $pages = array(
        '' => '\Home',
        '404' => '\ThreeZeroThree'
    );
} else {
    $pages = array(
        '' => '\Login',
        '404' => '\ThreeZeroThree'
    );
}

$pageClassName = '\Templates\MiAdmin\Page' . $pages[@$s[1]];

if(@$pages[@$s[1]] == '')
    $pageClassName = '';

if(@$s[1] == 'sign-out') {
    $Template->userC->signOut();
    header('Location: ' . $this->mi->baseUrl('miadmin'));
    die;
}

if(class_exists($pageClassName) and $pageClassName != '') {
    new $pageClassName();
} elseif($pageClassName != '') {
    $this->mi->errorPage(array('FrontEnd Error', '<em>' . $pageClassName . '</em> Not Found'));
} else {
    $this->mi->errorPage(array('404', 'Not Found'));
}