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

    $('.reject-pending').on('click', async function() {

        const name = $(this).parent().parent().find('.wrapper > .info > h4').text();
        const id = $(this).parent().parent().attr('data-id');

        const confirmationResult = await promptConfirmationDialog({
            title: "Reject " + name + "?",
            description: "By rejecting the student, it will automatically delete their pending account registration from the system!",
            options: {
                no: "Cancel",
                yes: "Reject & Delete"
            }
        });

        if (confirmationResult === 'yes') {

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: { action: 'reject', id: id },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) { console.log('meow') }
            });

        }

    })

})