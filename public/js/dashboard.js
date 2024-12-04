import { promptConfirmationDialog, promptAlert } from './globals.js';

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
    $('#admin-accounts-table').DataTable(tableArgs);
    $('#faculty-dashboard-students-table').DataTable(tableArgs);
    $('#faculty-dashboard-courses-table').DataTable(tableArgs);
    $('#faculty-dashboard-enrollees-table').DataTable(tableArgs);
    $('#faculty-dashboard-manage-courses-table').DataTable(tableArgs);

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
                success: function() {
                    
                    entry.remove();
                    promptAlert("Successfully rejected pending student account!");

                },
                error: function() { 
                    promptAlert("An error occured while rejecting a pending student account! Please try again later.");
                }
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
                success: function() {
                
                    entry.remove();
                    promptAlert("Successfully accepted pending student account!");
                
                },
                error: function() {

                    console.error("Error when accept pending student is invoked!");
                    promptAlert("An error occured while accepting a pending student account! Please try again later.");
                
                }
            });

        }
        
    });

    $('.add-faculty-account').on('click', function() {

        const html =
        `
        <div id="input-modal">
            <form method="POST" action="" id="add-faculty-account-form">
                <h4>Add faculty account</h4>  
                <div class="inputs">
                    <input type="hidden" name="action" value="add-faculty">
                    <input type="hidden" name="role" value="faculty">
                    <div class="form-group"> 
                        <label for="username">Username</label>
                        <input class="form-control single" type="text" name="username" placeholder="Username..." required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input class="form-control single" type="text" name="email" placeholder="Email address..." required>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First name</label>
                        <input class="form-control single" type="text" name="first_name" placeholder="First name..." required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name</label>
                        <input class="form-control single" type="text" name="last_name" placeholder="Last name..." required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control single" type="text" name="password" placeholder="Password..." required>
                    </div>
                </div>
                <div class="cta">
                    <button onclick="event.preventDefault(); $(this).parent().parent().parent().remove();" data-type="secondary">Cancel</button>
                    <button data-type="primary">Add Faculty Account</button>
                </div>
            </form>
        </div>
        `

        $('body').append(html);

        $('#add-faculty-account-form').on('submit', function(event) {

            event.preventDefault();

            $.ajax({
                url: 'https://localhost/aucres/api/dashboard.php',
                method: 'POST',
                data: $(this).serialize(),
                success: function() {
                    promptAlert('Successfully added a faculty account!');
                    $('#add-faculty-account-form').trigger('reset');
                    $('#add-faculty-account-form').parent().remove();
                },
                error: function() {
                    promptAlert('An error occured while adding a faculty account! Please try again later.')
                    console.error('An error occured while adding a faculty account!');
                }
            })

        })

    })

})