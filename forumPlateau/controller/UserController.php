<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;

    class UserController extends AbstractController implements ControllerInterface{

        public function index() {
            $this->redirectTo("home", "index");
        }

        public function profile() {
            // only a connected user can call this method via get
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }
            $topicManager = new TopicManager();

            $userId = $_SESSION["user"]->getId();

            $topics = $topicManager->postedTopics($userId);

            return [
                "view" => VIEW_DIR."user/profile.php",
                "data" => [
                    "title" => "User profile",
                    "topics" => $topics
                ]
            ];
        }

        public function updateUser() {
            if(empty($_FILES["picture"])) {
                $this->redirectTo("user", "profile");
            }

            $userManager = new UserManager();
            $topicManager = new TopicManager();

            // i sanitize the file name and path name
            $_FILES["picture"]["name"] = filter_var($_FILES["picture"]["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $_FILES["picture"]["tmp_name"] = filter_var($_FILES["picture"]["tmp_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // this is the directory where the file will be uploaded
            $uploadDir = ".".PUBLIC_DIR."/img/uploads/";
            $pathFile = $uploadDir . basename($_FILES["picture"]["name"]); // the path to the file

            $newFileName = "";
            $formErrors = [];

            $userId = $_SESSION["user"]->getId();

            $topics = $topicManager->postedTopics($userId);

            // file upload vulnerabilities to cover
            // the size of the file
            if($_FILES["picture"]["size"] > 10000 ) { // i limit the size to 10 MegaBytes (10000 KiloBytes)
                $formErrors["picture"] = "File is too big";
            }
            
            // the extention of the file, by using the mime type we can precisely chose the files to accept
            if ($_FILES["picture"]["type"] != "image/wepb" && $_FILES["picture"]["type"] != "image/jpeg" && $_FILES["picture"]["type"] != "image/png") {
                $formErrors["picture"] = "Not the right format";
            }

            if(empty($formErrors["picture"])) {
                // all of the mime type that i accept and their extension
                $pictureTypes = [
                    "image/png" => ".png",
                    "image/jpeg" => ".jpg",
                    "image/webp" => ".webp"
                ];

                // i rename and apply the correct extension to the file name
                // using uniquid to make it random and unique
                foreach($pictureTypes as $mime => $ext) {
                    if($_FILES["picture"]["type"] == $mime) {
                        $newFileName = uniqid().$ext;
                    }
                }

                $_FILES["picture"]["name"] = $newFileName;
                $pathFile = $uploadDir . basename($_FILES["picture"]["name"]); // the path of my picture

                if(!move_uploaded_file($_FILES["picture"]["tmp_name"], $pathFile)) {
                    $formErrors["picture"] = "There was a problem somewhere";

                    return [
                        "view" => VIEW_DIR."user/profile.php",
                        "data" => [
                            "title" => "User profile",
                            "topics" => $topics,
                            "formErrors" => $formErrors
                        ]
                    ];
                }

                $dataUser = [
                    "id" => $userId,
                    "picture" => $_FILES["picture"]["name"]
                ];

                $userManager->update($dataUser, $userId);

                $this->redirectTo("user", "profile");
            } 

            return [
                "view" => VIEW_DIR."user/profile.php",
                "data" => [
                    "title" => "User profile",
                    "topics" => $topics,
                    "formErrors" => $formErrors
                ]
            ];

        }
    }
