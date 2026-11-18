jQuery(function($) {
    var canBeLoaded = true, // this param allows to initiate the AJAX call only if necessary
        bottomOffset = 2500; // the distance (in px) from the page bottom when you want to load more posts

    $(window).scroll(function () {
        var data = {
            'action': 'loadmore',
            'query': seasons_loadmore_params.posts,
            'page': seasons_loadmore_params.current_page
        };


        if ($(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded == true) {
            $.ajax({
                url: seasons_loadmore_params.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    // you can also add your own preloader here
                    // you see, the AJAX call is in process, we shouldn't run it again until complete
                    canBeLoaded = false;
                },
                failure: function(f){
                    console.log(f);
                },
                success: function (data) {
                    if (data) {

                        $('article').find('section:last-of-type').after(data); // where to insert posts
                        canBeLoaded = true; // the ajax is completed, now we can run it again
                        seasons_loadmore_params.current_page++;
                    }
                }
            });
        }
    });

});