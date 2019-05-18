<?php
/*
Page Name: Admin Login
*/

namespace Templates\MiAdmin\Page;

use Templates\MiAdmin\Template;

class Login extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->phpfunc();
        $this->content();
    }

    public function phpfunc()
    {
        if(isset($_POST['ajax'])) {
            $ajax = $_POST['ajax'];

            if($ajax == 'login') {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                if($username == '' || $password == '') {
                    $this->alert('danger', 'Hata!', 'Giriş Bilgilerinizi Kontrol Ediniz!');
                } else {
                    $loginn = $this->userC->signInForm($username, $password);
                    if($loginn == false) {
                        $this->alert('danger', 'Hata!', 'Giriş Bilgilerinizi Kontrol Ediniz!');
                    } else {
                        $this->userC->signIn($loginn);
                        $this->alert('success', 'Giriş Başarılı!', 'Yönlendiriliyorsunuz...', false);
                        $this->mi->jsRedirect($this->mi->baseUrl('miadmin'), 2000);
                    }
                }
            }

            die;
        }
    }

    public function content()
    {
        ?><?php
    }
}