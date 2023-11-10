<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct() {
            parent::connect();
        }

        public function popularTopics() {

            $sql = 
            "SELECT 
                t.id_topic,
                t.title,
                ta.label,
                COUNT(m.topic_id) AS nb_messages
            FROM 
                topic t
            INNER JOIN 
                tag ta ON t.tag_id = ta.id_tag
            INNER JOIN 
                message m ON t.id_topic= m.topic_id
            GROUP BY 
                t.id_topic
            ORDER BY 
                nb_messages DESC
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    }