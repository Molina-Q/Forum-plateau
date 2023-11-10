<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity {

        private $id;
        private $username;
        private $password;
        private $email;
        private $creationDate;
        private $role;
        private $picture;

        private $topics = [];
        private $messages = [];

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        // /**
        //  * Set the value of id
        //  *
        //  * @return  self
        //  */ 
        // public function setId($id)
        // {
        //     $this->id = $id;

        //     return $this;
        // }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
            return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
            $this->username = $username;

            return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            $this->email = $email;

            return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
            return $this->role;
        }
        
        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
            $this->role = $role;

            return $this;
        }

        /**
         * Get the value of picture
         */ 
        public function getPicture()
        {
            return $this->picture;
        }

        /**
         * Set the value of picture
         *
         * @return  self
         */ 
        public function setPicture($picture)
        {
            $this->picture = $picture;

            return $this;
        }

        public function getCreationDate(){
            $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }

        public function addTopics($topicEntity) {
            $this->topics[] = $topicEntity;
            return $this;
        }

        public function addMessages($messageEntity) {
            $this->messages[] = $messageEntity;
            return $this;
        }

        // /**
        //  * Get the value of closed
        //  */ 
        // public function getClosed()
        // {
        //         return $this->closed;
        // }

        // /**
        //  * Set the value of closed
        //  *
        //  * @return  self
        //  */ 
        // public function setClosed($closed)
        // {
        //         $this->closed = $closed;

        //         return $this;
        // }
    }
