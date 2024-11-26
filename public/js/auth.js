$(() => {
    
    $('.togglePassword').on('click', function() {
    
        const passwordField = $(this).closest('.input-group').find('.form-control');
        const passwordFieldType = passwordField.attr('type');
        
        if (passwordFieldType === 'password') {
    
            passwordField.attr('type', 'text');
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
    
        } else {
    
            passwordField.attr('type', 'password');
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
    
        }
    
    })

})