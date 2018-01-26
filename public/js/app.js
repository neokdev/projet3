$(function () {

    //Modal
    $('#deleteModal').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = $(event.relatedTarget); 
        // Extract info from data-* attributes
        let type = button.data('type');
        let title = button.data('title');
        let link = button.data('link');
        let date = button.data('date');
        let author = button.data('author');
        let modal = $(this);
        if (type === "billet") {
            modal.find('#modal-type').text("Supprimer le billet");
            modal.find('#modal-body').text("Voulez-vous vraiment supprimer ce billet de façon permanente ?");
        } if (type === "comment") {
            modal.find('#modal-type').text("Supprimer le commentaire");
            modal.find('#modal-body').text("Voulez-vous vraiment supprimer ce commentaire de façon permanente ?");
        } if (type === "user") {
            modal.find('#modal-type').text("Supprimer l'administrateur");
            modal.find('#modal-body').text("Voulez-vous vraiment supprimer cet administrateur de façon permanente ?");
        } 
        
        if (type === "billet") modal.find('#modal-title').text("\"" + title + "\"");
        if (type === "comment") modal.find('#modal-title').text("Dans le billet : \"" + title + "\"");
        if (type === "user") modal.find('#modal-title').text("Avec l'adresse email : \"" + title + "\"");

        if (date !== undefined) modal.find('#modal-date').text("Créé le : " + date);

        if (author !== undefined) modal.find('#modal-author').text("Commentaire de " + author);
        
        modal.find('#ok').attr('href', link);
    });

    $('#reportModal').on('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = $(event.relatedTarget); 
        // Extract info from data-* attributes
        let title = button.data('title');
        let link = button.data('link');
        let content = button.data('content');
        let modal = $(this);
        
        modal.find('#modal-title').text("Commentaire de " + title);
        modal.find('#modal-content').text("\"" + content + "\"");
        
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