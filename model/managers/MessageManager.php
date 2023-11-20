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
    }