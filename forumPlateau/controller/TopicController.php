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
                    "title" => "List of topics",
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ],
                "meta" => "list of every topics on the site"
            ];
        
        }

        public function addTopicForm($tagId = null) { 
            //in case someone who isn't registered try to manipulate the url he cannot access the page
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }

            $tagManager = new TagManager();
            $tags = $tagManager->findAll();

            if(isset($tagId)) {
                $this->existInDatabase($tagId, $tagManager);

                return [
                    "view" => VIEW_DIR."topic/addTopicForm.php",
                    "data" => [
                        "title" => "Topic creation",
                        "idTag" => $tagId,
                        "tags" => $tags
                    ],
                    "meta" => "creation form used to create topics"
                ];

            } else {

                return [
                    "view" => VIEW_DIR."topic/addTopicForm.php",
                    "data" => [
                        "title" => "Topic creation",
                        "tags" => $tags
                    ],
                    "meta" => "creation form used to create topics"
                ];
                
            }

        }

        public function addTopic() {
            //in case someone who isn't registered try to manipulate the url he cannot access the page
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }

            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            $currentDate = new \DateTime("now");
            
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            $tag = filter_input(INPUT_POST, "tag", FILTER_SANITIZE_NUMBER_INT); 

            $idUser = $_SESSION["user"]->getId();

            if(empty($title)) {
                $formErrors["title"] = "This field is mandatory!";
            }

            if(empty($text)) {
                $formErrors["text"] = "This field is mandatory!";
            }
            
            $dataTopic = [
                "title" => $title,
                "creationDate" => $currentDate->format("Y-m-d H:i:s"),
                "tag_id" => $tag,
                "user_id" => $idUser
            ];

            // i do this because add() call the insert() function and it return the id of the entity we added
            $idTopic = $topicManager->add($dataTopic);

            $dataMessage = [
                "text" => $text,
                "creationDate" => $currentDate->format("Y-m-d H:i:s"),
                "topic_id" => $idTopic, // need to finish this line
                "user_id" => $idUser
            ];

            $messageManager->add($dataMessage);

            $this->redirectTo("message", "showMessages", $idTopic);
        }

        public function updateTopicForm($idTopic) {
            $topicManager = new TopicManager;
            $topic = $topicManager->headerTopic($idTopic);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idTopic, $topicManager);

            return [
                "view" => VIEW_DIR."topic/updateTopicForm.php",
                "data" => [
                    "title" => "Topic update",
                    "topic" => $topic
                ],
                "meta" => "update an existing topi"
            ];
        }

        public function updateTopic($idTopic) {
            $topicManager = new TopicManager;
            $messageManager = new MessageManager;

            $this->existInDatabase($idTopic, $topicManager);

            // this is only used to check if the user is indeed the author or an admin, so it can be overwritten later
            $topic = $topicManager->findOneById($idTopic);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $topic = $topicManager->headerTopic($idTopic);
            $idMessage = $topic->getIdMessageAuthor();

            $dataTopic = [
                "id" => $idTopic,
                "title" => $title
            ];

            $dataMessage = [
                "id" => $idMessage,
                "text" => $text
            ];

            $topicManager->update($dataTopic, $idTopic);
            $messageManager->update($dataMessage, $topic->getIdMessageAuthor());
            
            $this->redirectTo("message", "showMessages", $idTopic);
        }

        public function deleteTopic($idTopic) {
            $topicManager = new TopicManager;
            $messageManager = new MessageManager;

            $this->existInDatabase($idTopic, $topicManager);

            $topic = $topicManager->findOneById($idTopic);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $messageManager->deleteMessages($idTopic);
            $topicManager->delete($idTopic);

            $this->redirectTo("home", "index");
        }

        /**
         * closes a topic by changing the 'closed' attribut to true
         */
        public function closeTopic($idTopic) {
            $topicManager = new TopicManager;

            $this->existInDatabase($idTopic, $topicManager);

            $dataTopic = [
                "id" => $idTopic,
                "closed" => "true"
            ];

            if ($topicManager->update($dataTopic)) {
                $this->redirectTo("message", "showMessages", $idTopic);
            } else {
                $this->redirectTo("topic", "listTopics");
                
            }
        }

        /**
         * open a topic by changing the 'closed' attribut to false
         */
        public function openTopic($idTopic) {
            $topicManager = new TopicManager;

            $this->existInDatabase($idTopic, $topicManager);

            $dataTopic = [
                "id" => $idTopic,
                "closed" => "false"
            ];

            if ($topicManager->update($dataTopic)) {
                $this->redirectTo("message", "showMessages", $idTopic);
            } else {
                $this->redirectTo("topic", "listTopics");
                
            }
        }

    }
