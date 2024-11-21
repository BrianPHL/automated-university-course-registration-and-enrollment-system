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
        inputsHandler();

    }

    const inputsHandler = () => {

        const functionName = "inputsHandler";

        debug("init", functionName)

        $('.form-control').on('focus', function() {
            $(this).closest('.input-group').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.input-group').removeClass('focused');
        });

        $('.togglePassword').on('click', function() {

            const passwordField = $(this).closest('.input-group').find('.form-control');
            const passwordFieldType = passwordField.attr('type');
            
            if (passwordFieldType === 'password') {

                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');

            } else {

                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');

            }

        })
        
        debug("done", functionName)

    }

    init();

});