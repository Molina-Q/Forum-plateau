<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    use Model\Managers\TagManager;
    
    class TopicController extends AbstractController implements ControllerInterface{

        public function index() {
          
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."topic/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ]
            ];
        
        }

        public function addTopicForm($idTag, $formErrors = [], $fieldData = []) {
            if(empty($_SESSION["user"])) { //in case someone who isn't registered try to manipulate the url he cannot access the page
                $this->redirectTo("home", "index");
            }

            $tagManager = new TagManager();
            $tags = $tagManager->findAll();

            return [
                "view" => VIEW_DIR."topic/addTopicForm.php",
                "data" => [
                    "idTag" => $idTag,
                    "tags" => $tags
                ]
            ];
        }

        public function addTopic() {
            if(empty($_SESSION["user"])) { //in case someone who isn't registered try to manipulate the url he cannot access the page
                $this->redirectTo("home", "index");
            }

            $topicManager = new TopicManager();

            $currentDate = new \DateTime("now");
            $idUser = $_SESSION["user"]->getId();

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $tag = filter_input(INPUT_POST, "tag", FILTER_SANITIZE_NUMBER_INT); 

            $dataTopic = [
                "title" => $title,
                "creationDate" => $currentDate,
                "tag_id" => $tag,
                "user_id" => $idUser
            ];

            $dataMessage = [
                "text" => $text,
                "creationDate" => $currentDate,
                "topic_id" => lastinsetedId(), // need to finish this line
                "user_id" => $idUser
            ];


            $topicManager->add();
            return [
                "view" => VIEW_DIR."topic/addTopicForm.php",
                "data" => [
                    "idTag" => $idTag,
                    "tags" => $tags
                ]
            ];
        }



    }
