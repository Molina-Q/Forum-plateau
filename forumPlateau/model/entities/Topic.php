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
        private $messageAuthor; // the message that the author write while creating the topic


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
            $formattedDate = $this->creationDate->format("d/m/Y, H:i:s");
            return $formattedDate;
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
         * Convert the creationDate var to a formated version
         * 
         * @return  string
         */ 
        public function convertDate() {
                $dateTimeCreation = $this->creationDate; // creationDate
                $currentDate = new \DateTime("now"); // the actual time 
                $timeInterval = date_diff($dateTimeCreation, $currentDate); // the interval between the date of creation and now
                $EndString = " ago";

                // will be used to check the first one to not be empty
                $formatInterval = [
                        "%Y" => "year",
                        "%m" => "month",
                        "%d" => "day"
                ];

                foreach($formatInterval as $properties => $stringFormat) {
                        $timeFormat = $timeInterval->format($properties);

                        if($stringFormat == "day" && $timeFormat >= "7") { // check if the interval is in days and if its longer than 7 days(a week)
                                $formatedTime = floor($timeFormat / 7); // is used to check how many week(s) it is by rounding down the division

                                if($formatedTime > "1") { // if that's longuer than a day there will be an "s" at the end
                                        $EndString = "s ago";
                                }

                                $formatedDateString = $formatedTime." week".$EndString;
                                return $formatedDateString;

                        } else if($timeFormat > "0") { // format the date as long as the the timeInterval isn't zero
                                if($timeInterval->format($properties) > "1") {
                                        $EndString = "s ago";
                                }

                                $formatedDateString = $timeInterval->format($properties." ".$stringFormat.$EndString);
                                return $formatedDateString;
                        }
                }

                // switch ($timeInterval->format("%a")) {
                //         case 'value':
                //                 # code...
                //                 break;
                                
                //         case 'value':
                //                 # code...
                //                 break;   

                //         case 'value':
                //                 # code...
                //                 break; 

                //         case 'value':
                //                 # code...
                //                 break;        

                //         default:
                //                 # code...
                //                 break;
                // }

                // return $this->getCreationDate();
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
