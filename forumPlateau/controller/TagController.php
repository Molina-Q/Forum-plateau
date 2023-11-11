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
                     "tags" => $TagManager->infoTags()
                     // "tags" => $TagManager->findAll(["id_tag", "ASC"])
                 ]
             ];
         
         }
    }
