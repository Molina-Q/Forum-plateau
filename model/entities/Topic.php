<?php
    namespace Model\Entities;

    use App\Entity;
    use DateTime;

    final class Topic extends Entity {

        // attributs originaly present in the database
        private $id;
        private $title;
        private $creationDate;
        // private $closed;
        private $user;
        private $tag;

        // attributs calculated in custom request and not present in the table
        private $nbMessages; // the number a topic has
        private $idMessageAuthor; //the id of the message that the author write while creating the topic
        private $messageAuthor; // the message that the author write while creating the topic
        private $countIteration;


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
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of tag
         *
         * @return  self
         */ 
        public function setTag($tag)
        {
                $this->tag = $tag;

                return $this;
        }

        /**
         * Get the value of tag
         */ 
        public function getTag()
        {
                return $this->tag;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        public function getCreationDate(){
                $formattedDate = $this->creationDate;
                return $formattedDate;
            }
    
        public function getFormattedDate($format = "Y-m-d H:i:s") {
                return $this->creationDate->format($format);
        }

        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of nbMessages
         */ 
        public function getNbMessages()
        {
                return $this->nbMessages;
        }

        /**
         * Set the value of nbMessages
         *
         * @return  self
         */ 
        public function setNbMessages($nbMessages)
        {
                $this->nbMessages = $nbMessages;

                return $this;
        }

        /**
         * Get the value of idMessageAuthor
         */ 
        public function getidMessageAuthor()
        {
                return $this->idMessageAuthor;
        }

        /**
         * Set the value of idmessageAuthor
         *
         * @return  self
         */ 
        public function setIdMessageAuthor($idMessageAuthor)
        {
                $this->idMessageAuthor = $idMessageAuthor;

                return $this;
        }

                /**
         * Get the value of messageAuthor
         */ 
        public function getMessageAuthor()
        {
                return $this->messageAuthor;
        }

        /**
         * Set the value of messageAuthor
         *
         * @return  self
         */ 
        public function setMessageAuthor($messageAuthor)
        {
                $this->messageAuthor = $messageAuthor;

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
