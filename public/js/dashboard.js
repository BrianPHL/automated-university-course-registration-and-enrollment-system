import { promptConfirmationDialog } from './globals.js';

const loadDashboardSection = (pSection) => {

    const section = '.' + pSection;

    $('#dashboardSection').children().css('display', 'none');
    $('#dashboardSection').find(section).css('display', 'flex');

}

const initializeTables = () => {

    $('#dashboard-table').DataTable({
        dom: '<"top"<"dt-start"lf><"dt-middle"ip><"dt-end">>rt',
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { className: 'dt-body-center', targets: [0] }
        ]
    });

    $('#all-student-accounts-table').DataTable({
        dom: '<"top"<"dt-start"lf><"dt-middle"ip><"dt-end">>rt',
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { className: 'dt-body-center', targets: [0] }
        ]
    });

    $('#pending-student-accounts-table').DataTable({
        dom: '<"top"<"dt-start"lf><"dt-middle"ip><"dt-end">>rt',
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { className: 'dt-body-center', targets: [0] }
        ]
    });

}

$(() => {

    initializeTables();

    $('.categories > button').on('click', function(event) {

        event.preventDefault();

        if ($(this).hasClass('active')) return;

        $(this).parent().find('button.active').removeClass('active');
        $(this).addClass('active');

        $(this).parent().parent().find('.table.active').css('display', 'none');

        $(this).parent().parent().find('.table[data-type=' + $(this).attr('data-category')).css('display', 'flex');

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

})