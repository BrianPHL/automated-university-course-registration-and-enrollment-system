import { promptConfirmationDialog } from './globals.js';

const loadDashboardSection = (pSection) => {

    const section = '.' + pSection;

    $('#dashboardSection').children().css('display', 'none');
    $('#dashboardSection').find(section).css('display', 'flex');

}

const initializeTables = () => {

    const tableArgs = {
        dom: '<"top"<"dt-start"lf><"dt-middle"ip><"dt-end">>rt',
        responsive: true,
        scrollX: true,
        columnDefs: [
            { className: 'dt-body-center', targets: [0] }
        ]
    }

    $('#dashboard-table').DataTable(tableArgs);
    $('#student-accounts-table').DataTable(tableArgs);
    $('#faculty-accounts-table').DataTable(tableArgs);

}

$(() => {

    initializeTables();

    $('.categories > button').on('click', function(event) {

        event.preventDefault();

        if ($(this).hasClass('active')) return;

        $(this).parent().find('button.active').removeClass('active');
        $(this).addClass('active');

        $(this).parent().parent().find('.table.active').css('display', 'none').removeClass('active');

        $(this).parent().parent().find('.table[data-type=' + $(this).attr('data-category')).css('display', 'flex').addClass('active');

    })

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

        loadDashboardSection($(this).attr('data-page'));

    })

    $("a.breadcrumb-link").on("click", function() {

        if ($(this).is('[data-page]') === false) { return; }

        const links = $('.panel > .nav > li');
        const active = $('.panel > .nav > li > a.active');

        active.removeClass('active');
        links.find('a[data-page=' + $(this).attr('data-page') + ']').addClass('active');

        loadDashboardSection($(this).attr('data-page'));

    })

    $('.logout').on('click', async function() {

        const confirmationResult = await promptConfirmationDialog({
            title: "Log out of your account?",
            description: "Logging out means any unsaved changes will be lost and you'll have to log back in!",
            options: {
                no: "Nevermind",
                yes: "Log me out of my account"
            }
        }, 'warn');

        if (confirmationResult === 'yes') {

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: {
                    action: 'logout',
                    location: 'portal'
                },
                dataType: 'json',
                success: function(response) { window.location.href = response.destination; },
                error: function() { console.error("Error when logout is invoked!"); }
            });

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
        }, 'warn');

        if (confirmationResult === 'yes') {

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: {
                    action: 'logout',
                    location: 'homepage'
                },
                dataType: 'json',
                success: function(response) { window.location.href = response.destination; },
                error: function() { console.error("Error when logout is invoked!"); }
            });

        }

    })

    $('.reject-pending').on('click', async function() {

        const entry = $(this).parent().parent();
        const name = entry.find('h4').text();
        const id = entry.attr('data-id');
        const confirmationResult = await promptConfirmationDialog({
            title: "Reject " + name + "?",
            description: "By rejecting the student, it will automatically delete their pending account registration from the system!",
            options: {
                no: "Cancel",
                yes: "Reject & Delete"
            }
        }, 'warn');

        if (confirmationResult === 'yes') {

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: { 
                    action: 'reject',
                    table: 'students',
                    id: id
                },
                success: function() { entry.remove(); },
                error: function() { console.log("Error when reject pending student is invoked!"); }
            });

        }

    })

    $('.accept-pending').on('click', async function() {

        const entry = $(this).parent().parent();
        const name = entry.find('h4').text();
        const id = entry.attr('data-id');
        const confirmationResult = await promptConfirmationDialog({
            title: "Accept " + name + "?",
            description: "By accepting the student, it will automatically make their account active and will be able to log in to their accounts.",
            options: {
                no: "Cancel",
                yes: "Accept Account Registration"
            }
        });

        if (confirmationResult === 'yes') {

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: { 
                    action: 'accept',
                    id: id
                },
                success: function() { entry.remove(); },
                error: function() { console.log("Error when accept pending student is invoked!"); }
            });

        }
        
    });

})