jQuery(document).ready(function(){
    jQuery("#validate").click(function(){
        var radioval  = jQuery("input[type='radio']:checked", ".wpcf7-form").val();
        if(typeof radioval === "undefined"){
        jQuery(".radio-alert").fadeIn();
         return false; 
        }else{
            jQuery(".radio-alert").fadeOut();
            return true;
        }
    }); 
    
    jQuery(".radio-391 .last input").click(function(){
        jQuery(".Other").fadeIn(1000,"linear");
    });
    
    jQuery(".radio-391 input").not(".last input").click(function(){
        jQuery(".Other").fadeOut(700,"linear");
        jQuery(".Other").val('');
    });
    
});