(function($){
    /*==================== SHOW NAVBAR ====================*/
    const toggleBtn = $('#header-toggle'), nav = $('#navbar');
    toggleBtn.click(() => {
        nav.toggleClass('show-menu');
        toggleBtn.toggleClass('bx-x');
    });

    if(!Modernizr.hovermq){
        $('.nav__dropdown .nav__link').click((e) => {
            e.preventDefault();
            let target = e.currentTarget;
    
            $(target).parent().toggleClass('show-dropdown');
            $(target).find('.nav__dropdown-icon').toggleClass('rotate-arrow');
        });
    }

    /*==================== LINK ACTIVE ====================
    const linkColor = document.querySelectorAll('.nav__link')

    function colorLink(){
        linkColor.forEach(l => l.classList.remove('active'))
        this.classList.add('active')
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink))*/
})(jQuery);
