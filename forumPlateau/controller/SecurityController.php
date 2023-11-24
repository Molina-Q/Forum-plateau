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
            $this->redirectTo("home", "index");
        }

        public function register($fieldData = [], $formErrors = []) {
            // if the user is already connected he cannot access this method
            if (Session::getUser()) {
                $this->redirectTo("home", "index");
            }
            
            return [
                "view" => VIEW_DIR."security/register.php",
                "data" => [
                    "title" => "Register"
                ]
            ];
        }

        // function used to register a user in the database (or not if there is any mistakes) 
        public function registerUser() {

            $userManager = new UserManager;

            //the data sent from the form with post method
            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $confirmEmail = filter_input(INPUT_POST, "confirmEmail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL); 
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

            //variables
            $currentDate = new \DateTime("now"); //for the creationDate of the account
            $formErrors = [];
            $formData = [];
            // regex: need at least 1 capital, 1 small, 1 number, 1 special char and 4 characters in total 
            //(the CNIL advise around 12 to be actually safe)
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/";

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

            // check regex password
            if(!preg_match($password_regex, $password)) {
                $formErrors["password"] = "the password isn't safe";
            }

            // check if the email and password are the same as their confirm counterpart
            if($email !== $confirmEmail) {
                $formErrors["confirmEmail"] = "The emails are not the same";
            }

            if($password !== $confirmPassword) {
                $formErrors["confirmPassword"] = "The passwords are not the same";
            }

            // check if username and email aren't already used (both are unique)
            $usernames = $userManager->findUsername();
            $emails = $userManager->findEmail();

            foreach($usernames as $everyUsername) {
                if($everyUsername->getUsername() === $username) {
                    $formErrors["username"] = "Username is invalid or already in use";
                }
            }

            foreach($emails as $everyEmail) {
                if($everyEmail->getEmail() === $email) {
                    $formErrors["email"] = "Email is invalid or already in use";
                }
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
                
                $this->redirectTo("security", "login"); // send the user to the login page
                
            } else { // mistake(s) were made in some of the input 

                $fieldData = [ // used to show the data already written in the fields
                    "username" => $username,
                    "email" => $email
                ];

                return [
                    "view" => VIEW_DIR."security/register.php",
                    "data" => [
                        "title" => "Register",
                        "fieldData" => $fieldData,
                        "formErrors" => $formErrors // used to show all the error messages
                    ]
                ];
            }

        }

        public function login() {
            // if the user i already connected he cannot access this method
            if (Session::getUser()) {
                $this->redirectTo("home", "index");
            }

            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => [
                    "title" => "Login"
                ]
            ];
            
        }

        // the function that connects (or not) the user once he enters and submits his email and password
        public function loginUser() {

            $userManager = new UserManager;

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // check if the fields are empty
            if(empty($email)) {
                $formErrors["email"] = "this field is mandatory";
            }
            
            if(empty($password)) {
                $formErrors["password"] = "this field is mandatory";
            }

            //check if the var are valid
            if(!$email) {
                $formErrors["email"] = "This field is invalid";
            }

            if(!$password) {
                $formErrors["password"] = "This field is invalid";
            }

            // if any of the check get triggered nothing happens
            if(empty($formErrors)) {
                // we get the user class by filtering it by email in an SQL request (emails are unique)
                $user = $userManager->findUser($email);

                // we check if the request turned good
                if($user) {
                    // we get hash the password 
                    $hashPassword = $user->getPassword();

                    // and we verify if the hashed password and what was put in the fields match
                    if (password_verify($password, $hashPassword)) {
                        //we create the user session
                        Session::setUser($user);
                        
                        $this->redirectTo("home", "index");
                    }
                }
            }
            // if any of my conditions fails it will end here
            $this->redirectTo("security", "login");
            
        }

        public function logout() {
            // get [user] out of SESSION, disconnecting him
            unset($_SESSION["user"]);

            $this->redirectTo("home", "index");
        }

        public function changePassword($formErrors = []) {

            return [
                "view" => VIEW_DIR."security/changePassword.php",
                "data" => [
                    "title" => "Change password",
                    "formErrors" => $formErrors
                ]
            ];
        }

        public function changePasswordUser() { 

            $userManager = new UserManager;

            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/";
            
            // check if empty
            if(empty($email)) {
                $formErrors["email"] = "this field is mandatory";
            }

            if(empty($password)) {
                $formErrors["password"] = "this field is mandatory";
            }
            
            if(empty($confirmPassword)) {
                $formErrors["confirmPassword"] = "this field is mandatory";
            }

            // check if it is non-null
            if(!$email) {
                $formErrors["email"] = "there was a mistake";
            }
            
            //  check if email isn't already in the database
            if(!$user = $userManager->findUser($email)) {
                $formErrors["email"] = "Email is invalid or already used";
            }

            if($password != $confirmPassword) {
                $formErrors["password"] = "the passwords are not the same";
            }

            // check regex password
            if(!preg_match($password_regex, $password)) {
                $formErrors["password"] = "the password isn't safe";
            }

            if(empty($formErrors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $user->setPassword($hashedPassword);

                $dataUser = [
                    "id" => $user->getId(),
                    "password" => $hashedPassword
                ];

                $userManager->update($dataUser);

                $this->redirectTo("security", "login");
            }

            $this->redirectTo("security", "changePassword");

        }
    }