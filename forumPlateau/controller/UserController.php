<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;

    
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
            $this->restrictTo("ROLE_USER");

            return [
                "view" => VIEW_DIR."user/profile.php"
            ];
        }
    }
