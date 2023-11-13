<?php
    namespace Model\Entities;

    use App\Entity;

    final class Message extends Entity {

        // attributs originaly present in the database
        private $id;
        private $text;
        private $creationDate;
        private $user;
        private $topic;

        // attributs calculated in custom request and not present in the table
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
         * Get the value of text
         */ 
        public function getText()
        {
            return $this->text;
        }

        /**
         * Set the value of text
         *
         * @return  self
         */ 
        public function setText($text)
        {
            $this->text = $text;

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
         * Set the value of topic
         *
         * @return  self
         */ 
        public function setTopic($topic)
        {
            $this->topic = $topic;

            return $this;
        }

        /**
         * Get the value of topic
         */ 
        public function getTopic()
        {
            return $this->topic;
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

        public function getFormattedDate($format) {
            return $this->creationDate->format($format);
        }

        public function setCreationDate($date){
            $this->creationDate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of countMessage
         */ 
        public function getCountIteration()
        {
            return $this->countIteration;
        }

        /**
         * Set the value of countMessage
         *
         * @return  self
         */ 
        public function setCountIteration($countIteration)
        {
            $this->countIteration = $countIteration;

            return $this;
        }

    }
