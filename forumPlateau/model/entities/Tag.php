<?php
    namespace Model\Entities;

    use App\Entity;

    final class Tag extends Entity {
        // attributs originaly present in the database
        private $id;
        private $label;
        private $desc;
        private $icon;

        // attributs calculated in custom request and not present in the table
        private $nbtopics;

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
         * Get the value of description
         */ 
        public function getDesc()
        {
                return $this->desc;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDesc($desc)
        {
                $this->desc = $desc;

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

        /**
         * Get the value of icon
         */ 
        public function getIcon()
        {
                return $this->icon;
        }

        /**
         * Set the value of icon
         *
         * @return  self
         */ 
        public function setIcon($icon)
        {
                $this->icon = $icon;

                return $this;
        } 
        
        /**
         * Get the value of the number of topics
         */ 
        public function getNbtopics()
        {
                return $this->nbtopics;
        }

        /**
         * Set the value of the number of topics
         *
         * @return  self
         */ 
        public function setNbtopics($nbtopics)
        {
                $this->nbtopics = $nbtopics;

                return $this;
        }

        public function showIcon() {
                $colorIcon = $this->getIcon();
                echo "<i class='fa-solid fa-circle' style='color:$colorIcon' ></i>";
        }
    }
