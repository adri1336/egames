let navbar = document.getElementById("navbar");
let navbar_img = document.getElementById("navbar-img");
var prevScrollpos = window.pageYOffset;

if(front_page)
{
    navbar_img.src = theme_directory + "/assets/img/logo.png";
    navbar.classList.remove("fixed");
}

window.onscroll = function()
{
    var currentScrollPos = window.pageYOffset;
    if(front_page)
    {
        if(currentScrollPos > 0)
        {
            navbar_img.src = theme_directory + "/assets/img/logo2.png";
            navbar.classList.add("fixed");
        }
        else
        {
            navbar_img.src = theme_directory + "/assets/img/logo.png";
            navbar.classList.remove("fixed");
        }
    }
    
    if(prevScrollpos > currentScrollPos) navbar.style.top = "0";
    else navbar.style.top = "-50px";
    
    prevScrollpos = currentScrollPos;
}