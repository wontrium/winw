

/* Screen height Property for set height to fit a display
http://www.w3schools.com/jsref/prop_screen_height.asp */

var height;
window.onload = function(event) {
    height = screen.height
    document.getElementById("container").style.height = height + "px";
}