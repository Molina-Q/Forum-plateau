//// toggleTheme ////
/**
 * change the theme color of the entire site
 * 
 */
function setTheme(theme) {
    
    rootElement.style.setProperty("--primary-color", `rgb(${theme.primary})`);
    rootElement.style.setProperty("--primary-color-lighter", `rgb(${theme.primaryLighter})`);
    rootElement.style.setProperty("--primary-color-darker", `rgb(${theme.primaryDarker})`);
    
    rootElement.style.setProperty("--background-color-general", `rgb(${theme.backgroundWhole})`);
    rootElement.style.setProperty("--background-color-footer", `rgb(${theme.backgroundFooter})`);
    
    rootElement.style.setProperty("--table-background-odd", `rgb(${theme.tableOdd})`);
    rootElement.style.setProperty("--table-background-even", `rgb(${theme.tableEven})`);
    
    rootElement.style.setProperty("--hypertext-color", `rgb(${theme.hyperText})`);
    rootElement.style.setProperty("--hypertext-color-hover", `rgb(${theme.hyperTextHover})`);
    
    rootElement.style.setProperty("--primary-text-color", `rgb(${theme.primaryText})`);
    rootElement.style.setProperty("--secondary-text-color", `rgb(${theme.secondaryText})`);
    rootElement.style.setProperty("--tertiary-text-color", `rgb(${theme.tertiaryText})`); 
}

/**
 * check the current theme and applies it
 */
function applyTheme(storagedTheme) {
    switch (storagedTheme) {
        case "lightTheme":
            setTheme(lightTheme);
            break;

        case "darkTheme":
            setTheme(darkTheme);
            break;
    
        default:
            break;
    }
}
/**
 * the dark/light mode icon
 */
const toggleTheme = document.getElementById("toggleTheme");

/**
 * root
 */
const rootElement = document.querySelector(":root");

/**
 * both of my themes
 */
const darkTheme = {
    // primary color
    primary: "32, 101, 192",
    primaryLighter: "41, 123, 230",
    primaryDarker: "26, 86, 163",

    // background color
    backgroundWhole: "40, 45, 71",
    backgroundFooter: "38, 38, 38",

    // table background
    tableOdd: "84, 93, 134",
    tableEven: "57, 66, 99",

    // hypertext link color
    hyperText: "183, 238, 255",
    hyperTextHover: "50, 207, 255",

    // text color
    primaryText: "255, 255, 255",
    secondaryText: "255, 255, 255",
    tertiaryText: "196, 220, 255"
};

const lightTheme = {
    // primary color
    primary: "41, 120, 166",
    primaryLighter: "50, 144, 199",
    primaryDarker: "26, 76, 105",

    // background color
    backgroundWhole: "232, 232, 232",
    backgroundFooter: "38, 38, 38",

    // table background
    tableOdd: "255, 255, 255",
    tableEven: "217, 217, 217",

    // hypertext link color
    hyperText: "5, 50, 92",
    hyperTextHover: "0, 43, 46",

    // text color
    primaryText: "255, 255, 255",
    secondaryText: "0, 0, 0",
    tertiaryText: "92, 92, 92"
};
/**
 * light and dark mode rgb values for each css var
 */
const colorThemes = [
    { // dark theme
        theme: darkTheme,
    },

    { // light theme
        theme: lightTheme,
    }
]

/*
* check if there is a theme in the locale storage
*/
if(!localStorage.getItem("themeIs")) {
    localStorage.setItem("themeIs", "darkTheme");
}

/**
 * current theme
 */
const colorThemeIs = localStorage.getItem("themeIs");

window.addEventListener("load", () => applyTheme(colorThemeIs));

setTheme(darkTheme);

toggleTheme.addEventListener("click", function() {
    switch (localStorage.getItem("themeIs")) {

        case "lightTheme":
                setTheme(darkTheme);
                localStorage.removeItem("themeIs");
                localStorage.setItem("themeIs", "darkTheme");
            break;

        case "darkTheme":
                setTheme(lightTheme);
                localStorage.removeItem("themeIs");
                localStorage.setItem("themeIs", "lightTheme");
            break;

        default:
            
            break;
    }
})


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
// eyeCon.addEventListener("click", () => togglePassword(passwordInput));



