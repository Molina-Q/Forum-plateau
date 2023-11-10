<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\MessageManager;
    use Model\Managers\TopicManager;
    // use Model\Managers\TagManager;
    
    class MessageController extends AbstractController implements ControllerInterface{

        public function index() {
            $id = $_GET["id"];
            $MessageManager = new MessageManager();
            $TopicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "messages" => $MessageManager->findByForeignId($id, "topic"),
                    "topic" => $TopicManager->findOneById($id)
                ] 
            ];
        }
    }