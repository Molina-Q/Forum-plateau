<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity {

        // attributs originaly present in the database
        private $id;
        private $username;
        private $password;
        private $email;
        private $creationDate;
        private $role;
        private $picture;

        // attributs calculated in custom request and not present in the table
        private $nbUser;
        private $countIteration; // the number of this entity in the database

        public function __construct($data, $isDeletedUser = false) {         
            // if the user was deleted and is null
            if ($isDeletedUser) {
                $this->id = null;
                $this->username = "<i>[deleted_user]</i>";
                $this->picture = "deleted.svg";
            } else {
                // else we hydrate as it normaly would
                $this->hydrate($data);
            }
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
            $this->id = $id;

            return $this;
        }

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
        * Get the value of password
        */ 
        public function getPassword()
        {
            return $this->password;
        }

        /**
        * Set the value of password
        *
        * @return  self
        */ 
        public function setPassword($password)
        {
            $this->password = $password;

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
            $formattedDate = $this->creationDate;
            return $formattedDate;
        }

        public function getFormattedDate($format) {
            return $this->creationDate->format($format);
        }

        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of nbUser
         */ 
        public function getNbUser()
        {
            return $this->nbUser;
        }

        /**
         * Set the value of nbUser
         *
         * @return  self
         */ 
        public function setNbUser($nbUser)
        {
            $this->nbUser = $nbUser;

            return $this;
        }

        /**
         * Get the value of countIteration
         */ 
        public function getCountIteration()
        {
            return $this->countIteration;
        }

        /**
         * Set the value of countIteration
         *
         * @return  self
         */ 
        public function setCountIteration($countIteration)
        {
            $this->countIteration = $countIteration;

            return $this;
        }

        public function __toString()
        {
            return $this->getUsername();
        }


        /**
        * check the role of the users
        *
        * @return  self
        */ 
        public function hasRole($role) {
            if ($this->getRole() === $role) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * create a <figure><img> elements with the link to the picture of the user then apply a class depending of the role of the user
         */
        public function showPicture() {
            $picture = $this->getPicture();
            $role = $this->getRole();
            switch ($role) {
                case 'ROLE_ADMIN':
                    $classPic = "pictureAdmin";
                    break;
                case 'ROLE_USER':
                    $classPic = "pictureUser";
                    break;                
                default:
                    $classPic = "pictureUser";
                    break;
            }
            
            echo "
            <figure class='$classPic'>
                <img src='./public/img/uploads/$picture' alt='$picture'>
            </figure>
            ";
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
