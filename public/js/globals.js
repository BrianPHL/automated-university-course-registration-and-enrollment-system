export const promptConfirmationDialog = (pMessage, pType = null) => {

    return new Promise((resolve) => {

        const message = (pMessage) ? pMessage : null;
        const type = (pType === 'warn') ? 'warning' : 'primary' ;

        if (!message || !type) return;

        const html =
        `
         <div id="confirmation-modal">
            <div class="content">
                <div class="message">
                    <h3 class="title">${ message['title'] }</h3>
                    <p class="description">${ message['description'] }</p>
                </div>
                <div class="cta">
                    <button id="modal-no" data-answer="no" data-type="secondary">${ message['options']['no'] }</button>
                    <button id="modal-yes" data-answer="yes" data-type="${ type }">${ message['options']['yes'] }</button>
                </div>
            </div>
        </div>
        `

        $('body').append(html);

        $('#confirmation-modal').find('button').on('click', function(event) {
            
            event.preventDefault();

            $('#confirmation-modal').remove();
            resolve($(this).attr('data-answer'));

        })

    })

}

export const promptInformationDialog = (message) => {

    const html =
    `
        <div id="information-modal">
            
        </div>
    `

    $('body').append(html);

}

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