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
            $this->redirectTo("home", "index");
        }
        
        public function showMessages($idTopic) {
            $messageManager = new MessageManager();
            $topicManager = new TopicManager();
            
            $this->existInDatabase($idTopic, $topicManager);
            
            $message = $messageManager->messagesResponse($idTopic); // the message posted on a topic (except the one the author wrote)
            $topic = $topicManager->headerTopic($idTopic); // all the information displayed on the header of a topic
            $closed = $topicManager->closed($idTopic);

            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "title" => "Topic details",
                    "messages" => $message, // return every messages from the topic ecxept the first one from the author
                    "topic" => $topic, // return the topic title and the first message that goes with it
                    "closed" => $closed,
                ], 
                "meta" => "List of messages from a topic ".$topic->getTitle()
            ];
        }

        // if the user isn't registered he cannot call the method
        public function addMessage($idTopic) {
            // if the user isn't registered he cannot access this method
            if(!Session::getUser()) {
                $this->redirectTo("home", "index");
            }
            
            $topicManager = new TopicManager();
            $messageManager = new MessageManager();
            
            $this->existInDatabase($idTopic, $topicManager);
            
            $currentDate = new \DateTime("now");
            $userId = $_SESSION["user"]->getId();
            $errorCheck = false;

            $message = $messageManager->messagesResponse($idTopic);
            $topic = $topicManager->headerTopic($idTopic);
            
            if(!$message || !$topic) {
                $this->redirectTo("security", "index");
            }

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // if the field is empty
            if(empty($text)) {
                Session::addFlash("text", "This field is mandatory!");
                $errorCheck = true;
            }

            if(!$errorCheck) {
                // contains all of the data necessary to create a new message
                $dataMessage = [
                    "text" => $text,
                    "creationDate" => $currentDate->format("Y-m-d H:i:s"),
                    "topic_id" => $idTopic,
                    "user_id" => $userId
                ];

                $messageManager->add($dataMessage);
            } 

            $this->redirectTo("message", "showMessages", $idTopic);
        }

        public function updateMessageForm($idMessage) {
            $messageManager = new MessageManager;
            $message = $messageManager->findOneById($idMessage);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($message->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idMessage, $messageManager);

            return [
                "view" => VIEW_DIR."message/updateMessage.php",
                "data" => [
                    "title" => "Update message",
                    "message" => $message
                ]
            ];
        }

        public function updateMessage($idMessage) {
            $messageManager = new MessageManager;
            $message = $messageManager->findOneById($idMessage);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($message->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idMessage, $messageManager);

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $dataMessage = [
                "id" => $idMessage,
                "text" => $text
            ];

            $messageManager->update($dataMessage, $idMessage);
            
            $this->redirectTo("message", "showMessages", $message->getTopic()->getId());
        }

        public function deleteMessage($idMessage) {
            $messageManager = new MessageManager;
            $message = $messageManager->findOneById($idMessage);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($message->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idMessage, $messageManager);

            $messageManager->delete($idMessage);

            $this->redirectTo("home", "index");
        }
    }
