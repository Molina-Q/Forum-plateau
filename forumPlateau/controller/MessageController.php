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
        
        public function showMessages($idTopic) {
            $messageManager = new MessageManager();
            $topicManager = new TopicManager();
            $formErrors = [];
            $message = $messageManager->messagesResponse($idTopic);
            $topic = $topicManager->headerTopic($idTopic);

            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "title" => "topic details",
                    "messages" => $message, // return every messages from the topic ecxept the first one from the author
                    "topic" => $topic, // return the topic title and the first message that goes with it
                    "formErrors" => $formErrors
                ], 
                "meta" => "Liste des messages du topic ".$topic->getTitle()
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
            $currentDate = new \DateTime("now");

            $formErrors = [];

            $message = $messageManager->messagesResponse($idTopic);
            $topic = $topicManager->headerTopic($idTopic);

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // if the field is empty
            if(empty($text)) {
                $formErrors["text"] = "This field is mandatory!";
            }

            if (empty($formErrors)) {
                $userId = $_SESSION["user"]->getId();

                if($userId) {
                    $dataMessage = [
                        "title" => "Message form",
                        "text" => $text,
                        "creationDate" => $currentDate->format("Y-m-d H:i:s"),
                        "topic_id" => $idTopic,
                        "user_id" => $userId
                    ];

                    $messageManager->add($dataMessage);
                }

                $this->redirectTo("message", "showMessages", $idTopic);

            } else {
                return [
                    "view" => VIEW_DIR."message/showMessages.php",
                    "data" => [
                        "title" => "topic details",
                        "messages" => $message, // return every messages from the topic ecxept the first one from the author
                        "topic" => $topic, // return the topic title and the first message that goes with it
                        "formErrors" => $formErrors
                    ], 
                    "meta" => "Liste des messages du topic ".$topic->getTitle()
                ];
            }

        }

        public function updateMessageForm($idMessage) {
            $messageManager = new MessageManager;
            $message = $messageManager->findOneById($idMessage);

            // if the user isn't an admin or the author of the message he cannot access this method
            // made for an extra layer of security
            if(!Session::isAuthorOrAdmin($message->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            return [
                "view" => VIEW_DIR."message/updateMessage.php",
                "data" => [
                    "title" => "Message form",
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

            $messageManager->delete($idMessage);

            $this->redirectTo("tag", "listTags");
        }
    }
