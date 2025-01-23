<?php
 class IndexController {
     
    public function index(){
/*         if(!empty($_SESSION['userLogged'])){
            //Logica para entrar al home, dashboard
        } else {
            //Logica de retorno al login
        } */
        //$this->verifyLogin();
       require __DIR__ . '/../view/homeView.php';
    }

    private function verifyLogin(){
        if (isset($_SESSION['userLoged'])) {
            header('Location: index.php?c=user&f=login');
            exit();
        }
    }
 }