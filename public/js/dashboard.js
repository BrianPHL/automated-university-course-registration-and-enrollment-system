import { promptConfirmationDialog } from './globals.js';

$(() => {

    $(".nav-link").on("click", function() {

        if ($(this).hasClass("dropdown")) {

            const caretIcon = $(this).find('i.fa-caret-down');

            ($(this).attr('aria-expanded') === 'true')
                ? caretIcon.css('transform', 'rotate(0deg)')
                : caretIcon.css('transform', 'rotate(180deg)');

            return;
        }
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
    
    });

    $("a.nav-link").on("click", function() {

        if ($(this).is('[data-page]') === false) { return; }
        
        const newURL = `https://localhost/aucres/public/dashboard.php?page=${$(this).attr('data-page')}`;
        history.pushState(null, '', newURL);

    })

    $('#dashboard-table').DataTable({
        dom: '<"top"<"dt-start"lf><"dt-middle"ip><"dt-end">>rt',
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { className: 'dt-body-center', targets: [0] }
        ]
    });

    $('.logout').on('click', async function() {

        const confirmationResult = await promptConfirmationDialog({
            title: "Log out of your account?",
            description: "Logging out means any unsaved changes will be lost and you'll have to log back in!",
            options: {
                no: "Nevermind",
                yes: "Log me out of my account"
            }
        });

        if (confirmationResult === 'yes') {

            window.location.href = 'https://localhost/aucres/api/dashboard.php?action=logout&where=portal';

        }

    });

    $('.return').on('click', async function() {

        const confirmationResult = await promptConfirmationDialog({
            title: "Return to homepage?",
            description: "Doing this will also log you out of your account. Any unsaved changes will be lost and you'll have to log back in!",
            options: {
                no: "Nevermind",
                yes: "Logout & Return to Homepage"
            }
        });

        if (confirmationResult === 'yes') {

            window.location.href = 'https://localhost/aucres/api/dashboard.php?action=logout&where=homepage';

        }

    })

})