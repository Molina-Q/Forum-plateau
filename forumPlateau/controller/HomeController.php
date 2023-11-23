<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    use Model\Managers\TagManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index() {
            $topicManager = new TopicManager();
            $tagManager = new TagManager();
            $userManager = new UserManager();
            $messageManager = new MessageManager();
            
            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "title" => "Home",
                    "topics" => $topicManager->popularTopics(),
                    "tags" => $tagManager->popularTags(),
                    "recents" => $topicManager->recentTopics(),
                    // related to the "statistics" div on the homePage
                    "statUsers" => $userManager->countElem(),
                    "statTopics" => $topicManager->countElem(),
                    "statMessages" => $messageManager->countElem()
                ]
            ];
        }       
   
        public function users() {
            $this->restrictTo("ROLE_ADMIN");

            $userManager = new UserManager();
            $users = $userManager->findAll(['creationDate', 'ASC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users,
                    "title" => "List of users"
                ]
            ];
        }

        public function forumRules() {
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
