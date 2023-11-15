<?php
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){
            $url = "index.php?";
            $url.= $ctrl ? "ctrl=".$ctrl : "";
            $url.= $action ? "&action=".$action : "";
            $url.= $id ? "&id=".$id : "";

            header("Location: $url");
            die();
        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("home", "index");
            }
            return;
        }

    }