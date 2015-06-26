function session_select(option){
    //var value = jQuery(".cat_sort select").val();
    choice = option.split(" ");
    if(choice.length > 1){
        value = choice[1];
    }else{
        value = choice[0];
    }
    value = value.toLowerCase();
        jQuery.ajax({
            type: "POST",
            url: ajax_object.ajaxurl,
            data: {
                action: 'select_session',
                val: value
            },
            success: function (response) {
                var url = window.location.href;
                var index = url.indexOf("?")
                if(index!=-1){
                    var edt_url = url.split("?");
                    window.location=edt_url[0];
                }
            },
            error: function () {
              //alert('Oops!! Something went wrong!! Try later!');
            }
        });
}

function category_sorting(cat_name,option){
    //var value = jQuery(".cat_sort select").val();
    
    choice = option.split(" ");
    if(choice.length > 1){
        value = choice[1];
    }else{
        value = choice[0];
    }
    value = value.toLowerCase();
    cat_name=(cat_name.toLowerCase());
    if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("sorting").innerHTML = xmlhttp.responseText;
                jQuery(".cat_sort_title h2").html(value+" Resources");
                //jQuery(".cat_sort select").val(value);
                jQuery(".sort_by").html(option);
            }
    }
    
    xmlhttp.open("GET","../"+cat_name+"?tab="+value,false);
    xmlhttp.send();

}
