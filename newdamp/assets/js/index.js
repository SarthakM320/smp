(function($){
    $('#search').blur((e) => {
        let clickedElement = e.relatedTarget; 
        if(clickedElement){
            window.location = clickedElement.getAttribute('href');
        }
        $('.nav__search').css({"border-radius": "1rem", "box-shadow": "none"});
        $('.nav__search-suggestions').hide();
    });

    $('#navbar').mouseleave(() => {
        $('#search').blur();
    });

    $('#search').focus(() => {
        if($('.nav__search-suggestions').children().length > 0){
            $('.nav__search').css({"border-radius": "1rem 1rem 0 0", "box-shadow": "0 0 5px 2px #bfbfbf"});
            $('.nav__search-suggestions').show();
        }
        else{
            $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
            $('.nav__search-suggestions').hide();
        }
    });


    let relative_path = $('#path-info').data('path').trim();
    function get_courses(){
        let location = relative_path + "assets/utils/get_search_info.php";
        return $.ajax({
            url: location,
            type: "GET"
        });
    }

    // Set search functionality
    function set_search(){
        let previous_input = [];
        
        $('#search').keyup((e) => {
            let target = e.currentTarget;
            let input = $(target).val();
            // Process the data
            input = input.replace(/[\W_]+/g," ").replace(/\s+/g," ").trim().toLowerCase().split(" ");
            unique_input = new Set(input);
            input = Array.from(unique_input);

            // Find the intersection between current and previous input
            let intersection = input.filter(value => previous_input.includes(value));
            if(!input[0]){
                let suggestions = $('.nav__search-suggestions');
                suggestions.php('');
                $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
                $('.nav__search-suggestions').hide();
            }
            else if(input[0] && (intersection.length !== previous_input.length || intersection.length !== input.length)){
                let suggestions = $('.nav__search-suggestions');
                suggestions.php('');                
                
                let scores = [];
                courses.forEach((course) => {
                    let score = 0;

                    input.forEach((keyword) => {
                        let position1 = course.title.search(keyword);
                        let position2 = course.code.search(keyword);
                        let position3 = course.department.search(keyword);
                        if(position1 !== -1 || position2 !== -1 || position3 !== -1){
                            score++;
                        }
                    });
                    scores.push(score);
                });

                let keys = Object.keys(scores);
                keys.sort((a,b) => {return scores[b]-scores[a];})

                for(let i = 0; i < 10; i++){
                    if(scores[keys[i]] > 0){
                        suggestions.append(`<a href="${relative_path}search.php?department=${courses[keys[i]].department}&code=${courses[keys[i]].code}" class="nav__search-option">${courses[keys[i]].display}</a>`);
                    }
                }                

                if(scores[keys[0]] > 0){
                    $('.nav__search').css({"border-radius": "1rem 1rem 0 0", "box-shadow": "0 0 5px 2px #bfbfbf"});
                    $('.nav__search-suggestions').show();
                }
                else{
                    $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
                    $('.nav__search-suggestions').hide();
                }
            }
            previous_input = input;
        });
        
        
        /* Another way of searching
        let individual_scores = [];
        let total_courses = courses.length;
        $('#search').keyup((e) => {
            let target = e.currentTarget;
            let input = $(target).val();
            // Process the data
            input = input.replace(/[\W_]+/g," ").replace(/\s+/g," ").trim().toLowerCase().split(" ");
            unique_input = new Set(input);
            input = Array.from(unique_input);

            // Find the intersection between current and previous input
            let intersection = [];
            let new_input = [];
            input.forEach((keyword) => {
                if(previous_input.includes(keyword)) {intersection.push(keyword);}
                else {new_input.push(keyword);}
            });

            if(!input[0]){
                let suggestions = $('.nav__search-suggestions');
                suggestions.php('');
                $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
                $('.nav__search-suggestions').hide();
            }
            else if(input[0] && (intersection.length !== previous_input.length || intersection.length !== input.length)){
                let suggestions = $('.nav__search-suggestions');
                suggestions.php('');
                
                var start = new Date().getTime();
                
                let insert_index = 0;
                let previous_input_length = previous_input.length;
                new_input.forEach((keyword) => {
                    let scores = courses.map((course) => {
                        if(course.title.search(keyword) !== -1 || course.code.search(keyword) !== -1 || course.department.search(keyword) !== -1) {return 1;}
                        else {return 0;}
                    });

                    while(insert_index < previous_input_length && intersection.includes(previous_input[insert_index])){
                        insert_index++;
                    }

                    if(insert_index < previous_input_length) {
                        previous_input[insert_index] = keyword;
                        individual_scores[insert_index] = scores;
                        insert_index++;
                    }
                    else {
                        previous_input.push(keyword);
                        individual_scores.push(scores);
                    }
                });

                let scores = new Array(total_courses).fill(0);
                previous_input.forEach((keyword, index) => {
                    if(input.includes(keyword)) {
                        for(let i = 0; i < total_courses; i++) {
                            scores[i] += individual_scores[index][i];
                        }
                    }
                    else {
                        previous_input[index] = null;
                    }
                });

                let keys = Object.keys(scores);
                keys.sort((a,b) => {return scores[b]-scores[a];})

                for(let i = 0; i < 10; i++){
                    if(scores[keys[i]] > 0){
                        suggestions.append(`<a href="${relative_path}search.php?department=${courses[keys[i]].department}&code=${courses[keys[i]].code}" class="nav__search-option">${courses[keys[i]].display}</a>`);
                    }
                }
                
                var end = new Date().getTime();
                var time = end - start;
                console.log('Execution time: ' + time);
                
                if(scores[keys[0]] > 0){
                    $('.nav__search').css({"border-radius": "1rem 1rem 0 0", "box-shadow": "0 0 5px 2px #bfbfbf"});
                    $('.nav__search-suggestions').show();
                }
                else{
                    $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
                    $('.nav__search-suggestions').hide();
                }
            }
        });*/

        document.getElementById('search').addEventListener('search', (e) => {
            let target = e.currentTarget;
            let input = $(target).val().trim();

            if(!input){
                let suggestions = $('.nav__search-suggestions');
                suggestions.php('');
                $('.nav__search').css({"border-radius": "1rem", "box-shadow": "0 0 5px 2px #bfbfbf"});
                $('.nav__search-suggestions').hide();
            }
            previous_input = input;
        });
    }
    
    // If data already saved in session storage, load and parse the data
    let courses = sessionStorage.getItem("courses");
    if(courses !== null){
        courses = JSON.parse(courses);
        set_search();
    }
    // If data already not saved, then fetch data from server and store in session storage
    else{
        courses = [];
        $.when(get_courses()).done((result) => {
            let result_decoded = JSON.parse(result);
            let status = result_decoded.status;
    
            if(status === "S"){
                $.each(result_decoded.courses, (index, course) => {
                    let display = `${course.department.toUpperCase()} ${course.code} - ${course.title}`;
                    let course_object = {"department": course.department, "code": course.code, "title": course.title.toLowerCase() , "display": display};
                    courses.push(course_object);
                });
                
                sessionStorage.setItem("courses", JSON.stringify(courses));
                set_search();
            }
            else{
                $.alert({
                    title: '<h3 class="text-danger text-monospace mb-1 mt-2">Error</h3>',
                    content: '<div>Sorry, there has been a technical problem.</div>'
                });
            }
        });
    }
    

    if($('.page-nav').length !== 0){
        /* Page-Navigation expand animation */
        var card = document.getElementById('activator');
        var tl = gsap.timeline({defaults: {ease: "power2.inOut"}});

        var toggle = false;

        tl.to('.activator', {
            background: '#805ad5',
            'borderRadius': '100px 100px 0 0'
        });
        tl.to('.page-nav nav', {
            'clipPath': 'polygon(-300% 0%, 100% 0%, 100% 100%, -300% 100%)'
        }, "-=.5");
        tl.to('.page-nav nav i', {
            opacity: 1,
            transform: 'translateY(0)',
            stagger: .05
        }, "-=.5");
        tl.pause();

        card.addEventListener('click', () => {
            toggle = !toggle;
            if (toggle ? tl.play() : tl.reverse());
        });        

        /* Page-Navigation active section switching */
        // Proper section scrolling
        document.querySelectorAll('a').forEach((anchor) => {
            var navigateTo = anchor.getAttribute('href');
            
            if(navigateTo[0] == '#'){
                anchor.addEventListener('click', (event) => {
                    event.preventDefault();
            
                    var idName = navigateTo.slice(1);
                    var id = document.getElementById(idName);
                    var idLocation = id.offsetTop;
                    var headerHeight = document.querySelector('.header').offsetHeight;
                    var lengthToScroll = idLocation - headerHeight;
                    
                    window.scroll(0,lengthToScroll);
                });
            }
        });
    
        // Navbar active section switching
        let infoboxPositions = [];
        var infoboxIDs = [];
        var infoboxAll = document.querySelectorAll('.section-info');
        infoboxAll.forEach(infobox => {
            infoboxIDs.push(infobox.getAttribute('id'));
        });
    
        // Calculate positions of all sections
        function calculatePositions() {
            var headerHeight = document.querySelector('.header').offsetHeight;
            var scrolledY = window.scrollY;
            var infoboxesNo = infoboxAll.length;
            infoboxPositions = [];
        
            for(let i = 0; i < infoboxesNo; i++){
                var positionVP = infoboxAll[i].getBoundingClientRect();
                infoboxPositions.push(scrolledY + positionVP.bottom - headerHeight - 1);
            }
        }
    
        var navbarClass = (window.innerWidth >= 768) ? '.page-nav' : '.mobile-page-nav';
        document.querySelector('.mobile-page-nav').style.display = 'none';
        var navbarShown = false;
        calculatePositions();

        // Recalculate section positions and change state on window resize
        window.onresize = () => {
            if(window.innerWidth >= 768 && navbarShown){
                document.querySelector('.mobile-page-nav').style.display = 'none';
                navbarShown = false;
            }
            navbarClass = (window.innerWidth >= 768) ? '.page-nav' : '.mobile-page-nav';
            calculatePositions();
        }
    
        var currentLabelID = '';

        window.addEventListener('scroll', () => {
            var scrolledY = window.scrollY;
            // While scrolling to extreme top or bottom, hide navbar on mobile screens
            if(navbarClass === '.mobile-page-nav'){
                if(!navbarShown && (scrolledY > 200 && scrolledY < document.documentElement.scrollHeight - window.innerHeight - 200)){
                    document.querySelector('.mobile-page-nav').style.display = 'flex';
                    navbarShown = true;
                }
                else if(navbarShown && (scrolledY <= 200 || scrolledY >= document.documentElement.scrollHeight - window.innerHeight - 200)){
                    document.querySelector('.mobile-page-nav').style.display = 'none';
                    navbarShown = false;
                }
            }

            // While scrolling, change active link according to active section
            var infoboxesNo = infoboxAll.length;
            for(let i = 0; i < infoboxesNo; i++){
                if(scrolledY <= infoboxPositions[i]){
                    if(infoboxIDs[i] != currentLabelID){
                        if(document.querySelector(`${navbarClass} a.active`)){
                            document.querySelector(`${navbarClass} a.active`).classList.remove('active');
                        }
                        document.querySelector(`${navbarClass} a[href="#${infoboxIDs[i]}"]`).classList.add('active');
                        currentLabelID = infoboxIDs[i];
                    }
                    break;
                }
            }
        });

        // Recalculate section positions if new content displayed or hidden
        $('.root-title, .leaf-title, .leaf-drop-content i').click(() => {
            setTimeout(function(){calculatePositions();}, 1000);
        });
    }

    
})(jQuery);