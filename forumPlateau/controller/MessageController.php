<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    use Model\Managers\TagManager;
    
    class MessageController extends AbstractController implements ControllerInterface{

        public function index() {
          
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/Topics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"]) // "topics" => topic's manager calls findAll() and receive the result of the query
                ]
            ];
        
        }
    }
