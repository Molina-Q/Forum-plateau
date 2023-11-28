<?php
    namespace App;

    class Session {

        private static $categories = ['error', 'success'];

        /**
        * add a messages to SESSION[$categ]
        */
        public static function addFlash($categ, $msg) {
            $_SESSION[$categ] = $msg;
        }

        /**
        *   show the message previously given with addFlash
        */
        public static function getFlash($categ) {
            
            if(isset($_SESSION[$categ])) {
                $msg = "<p class='error'>$_SESSION[$categ]</p>";  
                unset($_SESSION[$categ]);
            }
            else $msg = "";
            
            return $msg;
        }

        /**
        *   met un user dans la session (pour le maintenir connecté)
        */
        public static function setUser($user) {
            $_SESSION["user"] = $user;
        }

        public static function getUser() {
            return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
        }

        public static function isAdmin() {
            if(self::getUser() && self::getUser()->hasRole("ROLE_ADMIN")) {
                return true;
            }
            return false;
        }

        /**
         * check if the user is registered
         * & if he is an admin
         * or if he has the same id as the userId given in parameter
         * used to confirm that the user accessing the method is the author or an admin
         */
        public static function isAuthorOrAdmin($idAuthor) {
            if(self::getUser() && self::isAdmin()) {
                return true;

            } else if(self::getUser()->getId() == $idAuthor) {
                return true;

            } else {
                return false;

            }
        }

    }