// check if the menu is open or closed
function menuState(menu) {

    if(currentStyle.getPropertyValue("display") == "none") {
        return false;
    } else {
        menuToggle(menu);
    }
}
/**
 *  close or open the menu depending on his current state
 * @param {HTMLElement} menu 
 */
function menuToggle(menu) {

    if(currentStyle.getPropertyValue("display") == "none") {
        menu.style.display = "initial";
    } else {
        menu.style.display = "none";
    }
}
    
/**
 * show or hide the password depending on his current state
 * @param {HTMLElement} passwordElement
 */
function togglePassword(passwordElement) {
    if(passwordElement.type == "password") {
        passwordElement.type = "text";
        eyeCon.classList.remove("fa-eye");
        eyeCon.classList.add("fa-eye-slash");
    } else {
        passwordElement.type = "password";
        eyeCon.classList.remove("fa-eye-slash");
        eyeCon.classList.add("fa-eye");
    }
}

const navRight = document.getElementById("nav-right"); // right half of my nav
const blocBurger = document.getElementById("blocBurger"); // div that covers the whole menu burger
const iconBurger = document.getElementById("iconBurger"); // the burger menu icon

// clickable icons used to delete entities
const deleteIcon = document.getElementsByClassName("deleteIcon"); 

// val used to store the result of confirm() from the the deleteIcon 
let checkConfirm = true;

// array of the items present in the burger dropdown menu, makes it easier and faster to add items to the list
const listItems = [
    { // List topics
        label: "List of topics",
        ctrl: "topic",
        action: "listTopics" 
    },

    { // List tags
        label: "List of tags",
        ctrl: "tag",
        action: "listTags" 
    },

    { // List users
        label: "List users",
        ctrl: "home",
        action: "users" 
    }
]

// id eye icon
const eyeCon = document.getElementById("eyeCon");

const passwordInput = document.getElementById("password");

// menuBurger
const menuBurger = document.createElement("DIV");
menuBurger.classList.add("menuBurger");
blocBurger.appendChild(menuBurger);

// contentMenuBurger
const linkItemBurger = document.createElement("a");

const itemMenuBurger = document.createElement("P");
itemMenuBurger.classList.add("menuBurgerItem");

currentStyle = window.getComputedStyle(menuBurger);

// make every item in the listItems array appear in the burgerMenu has <burgerMenu><a><p>
listItems.forEach(item => {
    const newLink = linkItemBurger.cloneNode();
    const newItem = itemMenuBurger.cloneNode();

    newLink.setAttribute("href", "index.php?ctrl="+item.ctrl+"&action="+item.action);
    newItem.textContent = item.label;

    menuBurger.appendChild(newLink);
    newLink.appendChild(newItem);
})

// make the burgerMenu appear or disappear when clicking on the icon
iconBurger.addEventListener("click", () => menuToggle(menuBurger));

// when clicking anywhere on the screen while the menu is open it will close it
// window.addEventListener("click", function() {
//     if (currentStyle.getPropertyValue("display") !== "none") {
//         menuState(menuBurger);
//     }
// });

//// confirm delete ////
for (let i = 0; i < deleteIcon.length; i++) {
    // openDelete is the <a href="" class="deleteIcon"> element i clicked
    const openDelete = deleteIcon[i]; 
    
    openDelete.addEventListener("click", function() {
        // i store the string in his href
        let initialHref = openDelete.href; 

        // function that give the <a> element his initial href
        function updateHref() { 
            openDelete.href = initialHref;
        }

        checkConfirm = confirm("do you want to delete this ?");
        // if check is false the href is changed and the delete() method isn't called, if true the delete() function will be called 
        if(!checkConfirm) {
            openDelete.href = "#";
            setTimeout(updateHref, 2000); // write the initial href back after 2 seconds
        }
    })
}

//// showPassword //// 
eyeCon.addEventListener("click", () => togglePassword(passwordInput));


//// toggleTheme ////

const toggleTheme = getElementById("toggleTheme");

const colorSite = [
    { // light theme
        primary: "rgb(41, 120, 166)",
        primaryLight: "rgb(50, 144, 199)",
        primaryDark: "rgb(26, 76, 105)",
    
        secondary: "rgb(255, 255, 255)",
        backgroundWhole: "rgb(232, 232, 232)",
    
        tableHighlight: "rgb(217, 217, 217)",

        hypertext: "rgb(5, 50, 92)",
        hypertextHover: "rgb(0, 43, 46)",
    
        primaryText: "rgb(0, 0, 0)",
        secondaryText: "rgb(92, 92, 92)",
    
        backgroundFooter: "rgb(38, 38, 38)"
    },

    { // dark theme

    }
]