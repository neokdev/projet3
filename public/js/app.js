$(function () {

    //Modal
    $('#deleteModal').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = $(event.relatedTarget); 
        // Extract info from data-* attributes
        let title = button.data('title');
        let link = button.data('link');
        let date = button.data('date');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        let modal = $(this);
        modal.find('#modal-title').text("Voulez-vous vraiment supprimer ce billet de façon permanente ?" + title);
        modal.find('#modal-date').text("Créé le : " + date);
        modal.find('#ok').attr('href', link);
    });

    //Dismissable alert
    $('div .alert').alert();

    // Tab management
    $('.nav-tabs a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    if (location.hash) {
        $('a[href=\'' + location.hash + '\']').tab('show');
    }
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }

    $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
        e.preventDefault();
        let tab_name = this.getAttribute('href');
        if (history.pushState) {
            history.pushState(null, null, tab_name);
        } else {
            location.hash = tab_name;
        }
        localStorage.setItem('activeTab', tab_name);

        $(this).tab('show');
        return false;
    });
    $(window).on('popstate', function () {
        let anchor = location.hash ||
            $('a[data-toggle=\'tab\']').first().attr('href');
        $('a[href=\'' + anchor + '\']').tab('show');
    });
})