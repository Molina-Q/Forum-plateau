<?php
    namespace Model\Entities;

    use App\Entity;

    final class Tag extends Entity {

        private $id;
        private $label;

        private $topics = [];

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
         * Get the value of label
         */ 
        public function getLabel()
        {
                return $this->label;
        }

        /**
         * Set the value of label
         *
         * @return  self
         */ 
        public function setLabel($label)
        {
                $this->label = $label;

                return $this;
        }
       
    }
