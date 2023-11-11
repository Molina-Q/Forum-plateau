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

        public function infoTags() {
            $sql = 
            "SELECT 
                ta.id_tag,
                ta.label,
                ta.icon,
                ta.`desc`,
                COUNT(t.id_topic) AS nbtopics
            FROM 
                tag ta
            INNER JOIN 
                topic t ON ta.id_tag = t.tag_id 
            GROUP BY 
                ta.id_tag
            ORDER BY 
                ta.label ASC 
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    }