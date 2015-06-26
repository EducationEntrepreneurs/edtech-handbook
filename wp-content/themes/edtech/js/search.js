function auto_search(){
    var valsearch = jQuery('.search').val();
    var availableTags = ["explore"];
    
        jQuery.ajax({
            type: "POST",
            url: searchsuggest.url,
            data: {
                action: 'suggest_search',
                search: valsearch
            },
            success: function (response) {
                alert(response);
             
            },
            error: function () {
              alert('Oops!! Something went wrong!! Try later!');
            }
        });
}



