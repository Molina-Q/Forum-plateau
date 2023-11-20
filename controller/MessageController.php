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
            
            $message = $messageManager->messagesResponse($idTopic);
            $topic = $topicManager->headerTopic($idTopic);

            return [
                "view" => VIEW_DIR."message/showMessages.php",
                "data" => [
                    "messages" => $message, // return every messages from the topic ecxept the first one from the author
                    "topic" => $topic // return the topic title and the first message that goes with it
                ], 
                "meta" => "Liste des messages du topic ".$topic->getTitle()
            ];
        }

        public function addMessage($idTopic) {
            $messageManager = new MessageManager();
            $currentDate = new \DateTime("now");

            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // if the field is empty
            if(empty($text)) {
                $formErrors["text"] = "This field is mandatory!";
            }

            if (empty($formErrors)) {
                $userId = $_SESSION["user"]->getId();

                if($userId) {
                    $dataMessage = [
                        "text" => $text,
                        "creationDate" => $currentDate->format("Y-m-d H:i:s"),
                        "topic_id" => $idTopic,
                        "user_id" => $userId
                    ];
                }

                $messageManager->add($dataMessage);

                $this->redirectTo("message", "showMessages", $idTopic);
            } else {

                $this->redirectTo("message", "showMessages", $idTopic);
            }

        }
    }
