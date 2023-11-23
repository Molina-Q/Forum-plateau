<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TagManager;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    
    class TagController extends AbstractController implements ControllerInterface{

        public function index() {
          
           $TagManager = new TagManager();
           
            return [
                "view" => VIEW_DIR."tag/listTags.php",
                "data" => [
                    "title" => "List of tags",
                    "tags" => $TagManager->infoTags()
                    // "tags" => $TagManager->findAll(["id_tag", "ASC"])
                ]
            ];
        
        }

        public function listTags() {
          
            $TagManager = new TagManager();
            
            return [
                "view" => VIEW_DIR."tag/listTags.php",
                "data" => [
                    "title" => "List of tags",
                    "tags" => $TagManager->infoTags()
                    // "tags" => $TagManager->findAll(["id_tag", "ASC"])
                ]
            ];
        }

        public function detailsTag($id) {

            $tagManager = new TagManager();
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."tag/detailsTag.php",
                "data" => [
                    "title" => "Details of a tag",
                    "tag" => $tagManager->findOneById($id),
                    "topics" => $topicManager->topicsByTag($id)
                ]
            ];
        }

        


    }
