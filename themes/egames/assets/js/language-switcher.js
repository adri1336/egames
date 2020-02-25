let myLocale = document.getElementById("myLocale");
myLocale.addEventListener('change', function()
{
    var url = new URL(window.location);
    var locale = myLocale.options[myLocale.selectedIndex].value;
    if(locale == "")
    {
        locale = "en_US";
    }
    url.searchParams.append('language', locale);
    window.location = url;
});