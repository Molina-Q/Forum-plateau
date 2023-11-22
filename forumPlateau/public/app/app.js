/* var */
function menuState(menu) {

    if(currentStyle.getPropertyValue("display") == "none") {
        return false;
    } else {
        menuToggle(menu);
    }
}

function menuToggle(menu) {
    

    if(currentStyle.getPropertyValue("display") == "none") {
        menu.style.display = "initial";
    } else {
        menu.style.display = "none";
    }
}

const navRight = document.getElementById("nav-right"); // right half of my nav
const blocBurger = document.getElementById("blocBurger"); // div that covers the whole menu burger
const iconBurger = document.getElementById("iconBurger"); // the burger menu icon

// clickable icons used to delete entities
const deleteIcon = document.getElementsByClassName("deleteIcon"); 

// val used to store the result of confirm() from the the deleteIcon 
let checkConfirm = true;

const listItems = [
    { // List topics
        label: "List of topics",
        ctrl: "topic",
        action: "listTopics" 
    }

]

// menuBurger //
const menuBurger = document.createElement("DIV");
menuBurger.classList.add("menuBurger");
blocBurger.appendChild(menuBurger);

// contentMenuBurger
const linkItemBurger = document.createElement("a");
linkItemBurger.setAttribute("href", "index.php?ctrl=topic&action=listTopics");

const itemMenuBurger = document.createElement("P");
itemMenuBurger.classList.add("menuBurgerItem");
itemMenuBurger.textContent = "List Topics";

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

// confirm delete //
for (let i = 0; i < deleteIcon.length; i++) {
    const openDelete = deleteIcon[i]; // openDelete is the <a href="" class="deleteIcon"> element i clicked
    
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
