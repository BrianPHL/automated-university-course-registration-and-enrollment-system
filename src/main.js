$(() => {

    const debug = (type, methodName) => {

        switch (type) {

            case "init":
                console.log("[DEBUG]: Starting initialization of module: " + methodName);
                break;

            case "done":
                console.log("[DEBUG]: Finished initialization of module: " + methodName);
                break;
        
            default:
                console.log("[DEBUG]: Invalid arguments passed! No effect.")
                break;
        }

    }
    
    const init = () => {

        console.log("[DEBUG]: Starting initialization of modules in main app.js!");
        themeHandler();

    }

    const themeHandler = () => {

        const functionName = "themeHandler";

        debug("start", functionName)

        const iconSwitch = (theme) => {

            const companyLogo = $(".brand > img");
            const favicon = $("#favicon");

            if (theme === "light") {
            
                switchBtn.addClass("fa-moon");
                switchBtn.removeClass("fa-sun");
                companyLogo.attr("src", "../../public/assets/logo/light-512.svg");
                favicon.attr("href", "../../public/favicon-light.ico");

            } else {

                switchBtn.addClass("fa-sun");
                switchBtn.removeClass("fa-moon");
                companyLogo.attr("src", "../../public/assets/logo/dark-512.svg");
                favicon.attr("href", "../../public/favicon-dark.ico");

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

        debug("done", functionName)

    }

    init();

});