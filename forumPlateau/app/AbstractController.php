<?php
    namespace App;
    use App\Session;

    abstract class AbstractController{

        public function index(){}
        
        /**
         * redirect to the ctrl and action specified
         */
        public function redirectTo($ctrl = null, $action = null, $id = null) {
            $url = "index.php?";
            $url.= $ctrl ? "ctrl=".$ctrl : "";
            $url.= $action ? "&action=".$action : "";
            $url.= $id ? "&id=".$id : "";

            header("Location: $url");
            die();
        }
        
        /**
         * check if the id exist in the database
         */
        public function existInDatabase($id, $manager) {
            if(empty($manager->findOneById($id)) ) {
                Session::addFlash("database", "This page no longer exist, this user account was deleted");
                $this->redirectTo("security", "index");
            }
            return;
        }

        /**
         * check if the user is registered
         * if he isn't the user is redirected to the home page
         */
        public function restrictToRegistered() {

            if(!Session::getUser()) {
                $this->redirectTo("home", "index");
            }
            return;
        }

        /**
         * restrict a method / page to specific role (currently ADMIN or USER)
         */
        public function restrictTo($role) {
        
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("home", "index");
            }
            return;
        }

    }