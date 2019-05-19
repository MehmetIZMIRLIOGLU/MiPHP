<?php
/**
 * Example Templates - MiPHP
 */

namespace Templates\MiPHP;

use Extensions\Mi\DatabasePDO;

if($_SERVER['PHP_SELF'] != '/index.php')
    header('Location: /');

class Template extends \Extensions\Mi\FrontEnd\Template
{
    public function __construct()
    {
        $this->dir = __DIR__ . '/';
        parent::__construct();
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

$this->getTemplateClasses($Template->phpDir);

$pages = array(
    '' => '\Home',
    '404' => '\ThreeZeroThree'
);

$pageClassName = '\Templates\MiPHP\Page' . $pages[@$s[0]];

if(@$pages[@$s[0]] == '')
    $pageClassName = '';

if(class_exists($pageClassName) and $pageClassName != '') {
    new $pageClassName();
} elseif($pageClassName != '') {
    $this->mi->errorPage(array('FrontEnd Error', '<em>' . $pageClassName . '</em> Not Found'));
} else {
    $this->mi->errorPage(array('404', 'Not Found'));
}