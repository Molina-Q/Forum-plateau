<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";

        public function __construct(){
            parent::connect();
        }

        /**
         * return every row from a user using an email (they are unique)
         */
        public function findUser($email) {
            $sql = 
            "SELECT 
                *
            FROM
                user 
            WHERE 
                email = :email 
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }

        /**
         * return every email in the database, is used during the registration to be sure that the email isn't already used
         */
        public function findEmail() {
            $sql = 
            "SELECT 
                email
            FROM
                user 
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        /**
         * return every username in the database, used for the same reason as above (username are also unique)
         */
        public function findUsername() {
            $sql = 
            "SELECT 
                username
            FROM
                user
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }


    }