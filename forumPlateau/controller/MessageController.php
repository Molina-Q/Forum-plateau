<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\MessageManager;
    use Model\Managers\TopicManager;
    use Model\Managers\TagManager;
    
    class MessageController extends AbstractController implements ControllerInterface{

        public function index() {
            $MessageManager = new MessageManager();
            $TopicManager = new TopicManager();

            $topic = $TopicManager->findOneById($id);
            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "messages" => $MessageManager->findByForeignId($id, "topic"),
                    "topic" => $topic,
                ], 
            ];
        }
        
        public function showMessages($id) {
            $MessageManager = new MessageManager();
            $TopicManager = new TopicManager();
            
            $topic = $TopicManager->headerTopic($id);
            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "messages" => $MessageManager->findByForeignId($id, "topic", ["creationDate", "ASC"]), // return every messages from the topic
                    "topic" => $TopicManager->headerTopic($id) // return the topic title and the first message that goes with it
                ], 
                "meta" => "Liste des messages du topic ".$topic->getTitle()
            ];
        }
    }
