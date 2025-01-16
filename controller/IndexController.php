<?php
 class IndexController {
     
    public function index(){
        if(!empty($_SESSION['userLogged'])){
            //Logica para entrar al home, dashboard
        } else {
            //Logica de retorno al login
        }
    }
 }