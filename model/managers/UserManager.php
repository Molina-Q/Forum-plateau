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