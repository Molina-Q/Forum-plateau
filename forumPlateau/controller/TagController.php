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
          

        }

        public function listTags() {
          
            $TagManager = new TagManager();
            
            return [
                "view" => VIEW_DIR."tag/listTags.php",
                "data" => [
                    "title" => "List of tags",
                    "tags" => $TagManager->infoTags()
                    // "tags" => $TagManager->findAll(["id_tag", "ASC"])
                ],
                "meta" => "list of every tags that can be applied on the site"
            ];
        }

        public function detailsTag($tagId) {

            $tagManager = new TagManager();
            $topicManager = new TopicManager();
            $tag = $tagManager->findOneById($tagId);
            $this->existInDatabase($tagId, $tagManager);

            return [
                "view" => VIEW_DIR."tag/detailsTag.php",
                "data" => [
                    "title" => "Details of a tag",
                    "tag" => $tag,
                    "topics" => $topicManager->topicsByTag($tagId)
                ],
                "meta" => "every topic tied to the tag ".$tag->getLabel()
            ];
        }

    }
