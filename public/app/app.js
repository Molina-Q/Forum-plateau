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

