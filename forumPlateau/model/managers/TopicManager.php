<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct() {
            parent::connect();
        }

        /**
         * return every row from topic, the id and text from the inital message that the auhtor wrote while creating the topic
         */
        public function headerTopic($id) {
            $sql = 
            "SELECT 
                t.id_topic,
                t.title,
                t.creationDate,
                t.tag_id,
                t.user_id,
                m.id_message AS idMessageAuthor,
                m.text AS messageAuthor
            FROM 
                topic t
            INNER JOIN 
                message m ON t.id_topic = m.topic_id
            WHERE 
                t.id_topic = :id
            ORDER BY 
                m.creationDate
            LIMIT 1
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        /**
         * return every topics depending on their tag
         */
        public function topicsByTag($id) {

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
                message m ON t.id_topic = m.topic_id
            WHERE 
                t.tag_id = :id
            GROUP BY 
                t.id_topic
            ORDER BY
                nbmessages DESC
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]), 
                $this->className
            );
        }

        /**
         * return the 5 topics with the most messages
         */
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

        /**
         * return the all the topics posted by a specific user
         */
        public function postedTopics($id) {

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
            WHERE
                t.user_id = :id
            GROUP BY 
                t.id_topic
            ORDER BY 
                t.creationDate DESC
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ["id" => $id]), 
                $this->className
            );
        }

        /**
         * return the last 5 most recent topics
         */
        public function recentTopics() {
            $sql = 
            "SELECT
                t.id_topic,
                t.title,
                t.creationDate,
                t.user_id,
                t.tag_id
            FROM 
                topic t
            ORDER BY 
                t.creationDate DESC
            LIMIT 5";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
    }