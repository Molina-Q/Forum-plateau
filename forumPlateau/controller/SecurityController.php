<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\MessageManager;
    use Model\Managers\TagManager;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index() {
          
        //    $topicManager = new SecurityManager();

            return [
                "view" => VIEW_DIR."security/register.php",
            ];
        
        }

        public function register($formData = [], $formErrors = []) {
    
                return [
                    "view" => VIEW_DIR."security/register.php",
                ];
            
            }

        // function used to register a user in the database (or not if there is any mistakes) 
        public function registerUser() {

            $userManager = new UserManager;

            //the data sent from the form with post method
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL); // or FILTER_SANITIZE_EMAIL
            $confirmEmail = filter_input(INPUT_POST, "confirmEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL); // only used to confirm the mail
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //only used to confirm the password

            //variables
            $currentDate = new \DateTime("now"); //for the creationDate of the account
            $formErrors = [];
            $formData = [];

            // check that all inputs were completed
            if(empty($username)) {
                $formErrors["username"] = "This field is mandatory!";
            }

            if(empty($email)) {
                $formErrors["email"] = "This field is mandatory!";
            }

            if(empty($confirmEmail)) {
                $formErrors["confirmEmail"] = "This field is mandatory!";
            }

            if(empty($password)) {
                $formErrors["password"] = "This field is mandatory!";
            }

            if(empty($confirmPassword)) {
                $formErrors["confirmPassword"] = "This field is mandatory!";
            }

            // check if the email and password are the same as their confirm counterpart
            if($email !== $confirmEmail) {
                $formErrors["confirmEmail"] = "The emails are not the same";
            }

            if($password !== $confirmPassword) {
                $formErrors["confirmPassword"] = "The passwords are not the same";
            }

          
            // if there is no mistakes 
            if (empty($formErrors)) {  
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // password_default utilise l'algorithme considéré comme le plus efficace par php

                $formData = [ // all of the data that is going to the database
                    "username" => $username,
                    "password" =>  $hashedPassword,
                    "email" => $email,
                    "creationDate" => $currentDate->format("Y-m-d H:i:s")
                ];

                $userManager->add($formData); // add all of those data the user table (via the userManager)
                
                return [
                    "view" => VIEW_DIR."security/login.php" // send the user to the login page
                ];
                
            } else { // mistake(s) were made in some of the input 
                // $this->register($formData, $formErrors); !! demander pk ça fonctionne pas !!

                $fieldData = [ // used to show the data already written in the fields
                    "username" => $username,
                    "email" => $email
                ];

                return [
                    "view" => VIEW_DIR."security/register.php",
                    "data" => [
                        "fieldData" => $fieldData,
                        "formErrors" => $formErrors // used to show all the error messages
                    ]
                ];
            }

        }

        public function login() {

                return [
                    "view" => VIEW_DIR."security/login.php",
                ];
            
            }
    }