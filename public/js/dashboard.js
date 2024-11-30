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

})