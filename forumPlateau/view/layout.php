<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $meta_description ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href=".<?= PUBLIC_DIR ?>/css/style.css">
    <title><?= $title ?></title>

</head>
<body>
    <div id="wrapper"> 

        <div id="mainPage">

            <header>
                <nav>
                    <div id="nav-left">
                        <a href="index.php">Home</a>

                        <!-- <form id="form-search" action="index.php?" method="post">
                            <label for="search-bar"></label>
                            <input id="search-bar" type="text" name="search-bar">
                            <button type="submit">Search</button>
                        </form> -->
                    </div>

                    <div id="nav-right">

                        <?php if(App\Session::getUser()) { ?>

                            <a href="index.php?ctrl=user&action=profile">
                                <i class="fas fa-user"></i>
                                <span id="profileName"><?= App\Session::getUser() ?></span>
                            </a>

                            <a href="index.php?ctrl=security&action=logout">Sign out</a>

                        <?php } else { ?>

                            <a href="index.php?ctrl=security&action=register">
                                <p>Sign in</p>
                            </a>   

                            <a href="index.php?ctrl=security&action=login">
                                <p>Login</p>
                            </a>

                        <?php } ?>
                        
                        <i class="fa-solid fa-circle-half-stroke" id="toggleTheme"></i>

                        <div id="blocBurger">
                            <i class="fa-solid fa-bars" id="iconBurger"></i>
                        </div>

                    </div>        

                </nav>

                <div id="sub-nav">
                    
                    <a href="index.php?ctrl=topic&action=listTopics">
                        <p>List of topics</p>
                    </a>
                
                    <a href="index.php?ctrl=tag&action=listTags">
                        <p>List of tags</p>
                    </a>

                    <?php if(App\Session::getUser()) { ?>

                        <a href="index.php?ctrl=home&action=users">
                            <p>List of users</p>
                        </a>
                        
                    <?php } ?>
                
                </div>

            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>

        </div>
        <footer>
            <p>&copy; 2023 - Forum CDA - <a href="/home/forumRules.html">Rules of the forum</a> - <a href="">Legal</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <!-- <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script> -->
    <script src=".<?= PUBLIC_DIR ?>/app/app.js"></script>
</body>
</html>