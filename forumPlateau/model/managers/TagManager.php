<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TagManager;

    class TagManager extends Manager{

        protected $className = "Model\Entities\Tag";
        protected $tableName = "tag";

        public function __construct() {
            parent::connect();
        }

    }