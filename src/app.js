$(document).ready(function() {
    
    if (localStorage.getItem("theme") === "dark") {
        $("html").attr("data-theme", "dark");
    } else {
        $("html").attr("data-theme", "light");
    }

    $("#theme-toggle").click(function() {
        const currentTheme = $("html").attr("data-theme");
        const newTheme = currentTheme === "light" ? "dark" : "light";
        
        $("html").attr("data-theme", newTheme);

        localStorage.setItem("theme", newTheme);
    });
});