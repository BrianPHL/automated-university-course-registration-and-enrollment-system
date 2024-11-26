$(() => {

    const iconSwitch = (theme) => {

        const companyLogo = $(".brand > img");
        const favicon = $("#favicon");
    
        if (theme === "light") {
        
            switchBtn.addClass("fa-moon");
            switchBtn.removeClass("fa-sun");
            companyLogo.attr("src", "./assets/logo/light.svg");
            favicon.attr("href", "./assets/favicon-light.ico");
    
        } else {
    
            switchBtn.addClass("fa-sun");
            switchBtn.removeClass("fa-moon");
            companyLogo.attr("src", "./assets/logo/dark.svg");
            favicon.attr("href", "./assets/favicon-dark.ico");
    
        }
    
    }
    const checkCurrTheme = () => {
    
        if (localStorage.getItem("theme") === "dark") {
            $("html").attr("data-theme", "dark");
            iconSwitch("dark");
        } else {
            $("html").attr("data-theme", "light");
            iconSwitch("light");
        }
    
    }
    const switchBtn = $(".theme-toggle");
    
    checkCurrTheme();
    
    switchBtn.on("click", () => {
    
        const currentTheme = $("html").attr("data-theme");
        const newTheme = (currentTheme === "light") ? "dark" : "light";
        
        iconSwitch(newTheme);
        $("html").attr("data-theme", newTheme);            
        localStorage.setItem("theme", newTheme);
    
    });

    $('.form-control').on('focus', function() {
        $(this).closest('.input-group').addClass('focused');
    }).on('blur', function() {
        $(this).closest('.input-group').removeClass('focused');
    });

})