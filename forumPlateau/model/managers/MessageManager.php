<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\MessageManager;

    class MessageManager extends Manager{

        protected $className = "Model\Entities\Message";
        protected $tableName = "message";

        public function __construct() {
            parent::connect();
        }

        /**
         * return every messages from a specfic topic, except the message that was created at the exact same time has the topic
         * (the message the author wrote)
         */
        public function messagesResponse($id) {

            $sql = 
            "SELECT 
                m.*
            FROM 
                message m
            INNER JOIN 
                topic t ON m.topic_id = t.id_topic
            WHERE 
                t.id_topic = :id 
            AND NOT 
                t.creationDate = m.creationDate
            ORDER BY 
	            m.creationDate
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ["id" => $id]), 
                $this->className
            );
        }

        /**
         * delete every message from a topic
         */
        public function deleteMessages($idTopic) {
            $sql =
            "DELETE FROM 
                message
            WHERE 
                topic_id = :id 
            ";

            return DAO::delete($sql, ['id' => $idTopic]); 
        }
    }