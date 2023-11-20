<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;

    
    class UserController extends AbstractController implements ControllerInterface{

        public function index() {
          
           $topicManager = new UserManager();

            return [
                "view" => VIEW_DIR."topic/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ]
            ];
        
        }

        public function profile() {

            $topicManager = new TopicManager;
            $userId = $_SESSION["user"]->getId();
            $topics = $topicManager->findByForeignId($userId, "user");

            return [
                "view" => VIEW_DIR."user/profile.php",
                "data" => [
                    "topics" => $topics
                ]
            ];
        }
    }
