<?php
/**
 * MiPHP Extensions
 */

namespace Extensions;

if($_SERVER['PHP_SELF'] != '/index.php') header('Location: /');

class Prepare
{
    protected $mi;

    public function __construct()
    {
        global $Mi;
        $this->mi = $Mi;
    }
}