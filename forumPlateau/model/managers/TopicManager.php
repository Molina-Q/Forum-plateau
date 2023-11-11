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

        public function headerTopic($id) {
            $sql = 
            "SELECT 
                t.*,
                m.text AS messageAuthor
            FROM 
                topic t
            INNER JOIN 
                message m ON t.id_topic = m.topic_id
            WHERE 
                t.id_topic = :id
            ORDER BY 
                m.creationDate ASC
            LIMIT 1
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function popularTopics() {

            $sql = 
            "SELECT 
                t.id_topic,
                t.title,
                t.creationDate,
                t.tag_id,
                t.user_id,
                COUNT(m.topic_id) AS nbmessages
            FROM 
                topic t
            INNER JOIN 
                message m ON t.id_topic= m.topic_id
            GROUP BY 
                t.id_topic
            ORDER BY 
                nbmessages DESC
            LIMIT 5
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    }