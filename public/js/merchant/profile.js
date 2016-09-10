jQuery('#timepicker-mon-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-mon-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-tue-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-tue-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-wed-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-wed-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-thu-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-thu-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-fri-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-fri-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-sat-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-sat-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-sun-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-sun-end-1').timepicker({showMeridian: false});
jQuery('#timepicker-ph-start-1').timepicker({showMeridian: false});
jQuery('#timepicker-ph-end-1').timepicker({showMeridian: false});

//Dropzone
Dropzone.options.profilePicture = {
    autoProcessQueue: false,
    init: function() {
        var myDropzone = this;
        $('#res_update_btn').on("click", function(e) {
            myDropzone.processQueue();
            if(myDropzone.files.length != 0) {
              e.preventDefault();
              e.stopPropagation();
            }
        });

        this.on("thumbnail", function(file){
            
            if (file.height < 500 && file.width < 500) {
                alert("Eatery Logo must be a square size with at least 500px x 500px.");
                myDropzone.removeFile(file);
                return false;
            }
        });
        this.on("success", function(file) { 
            if($('#has_cover_photo').val() == "false"){
                
                $('#restaurant_form').submit();
            }
        });

        this.on("sending", function(file) {
            if($('#has_cover_photo').val() == "false"){
                jQuery('#loading').removeAttr('style');
            }
        });

        this.on("complete", function(file) {
            jQuery('#loading').attr('style', 'visibility:hidden');
        });

        this.on("error", function(file) { 
            jQuery('#loading').attr('style', 'visibility:hidden');
            alert('Eatery Logo invalid format or Image size is too big.');
            myDropzone.removeFile(file);
        });
    }
};

Dropzone.options.coverPhoto = {
    autoProcessQueue: false,
    init: function() {
        var myDropzone = this;
        $('#res_update_btn').on("click", function(e) {
            myDropzone.processQueue();
            if(myDropzone.files.length != 0) {
              e.preventDefault();
              e.stopPropagation();
            }
        });

        this.on("addedfile", function(file) { $('#has_cover_photo').val('true') });

        this.on("thumbnail", function(file){
            if (file.height < 900 && file.width < 600) {
                
                alert("Logo Bacakground must be 3:2 ratio with at least 900px x 600px.");
                myDropzone.removeFile(file);
                return false;
            }
        });

        this.on("sending", function(file) {
            jQuery('#loading').removeAttr('style');
        });

        this.on("success", function(file) { 
            
            $('#restaurant_form').submit();
        });

        this.on("complete", function(file) {
            jQuery('#loading').attr('style', 'visibility:hidden');
        });
        
        this.on("error", function(file) { 
            jQuery('#loading').attr('style', 'visibility:hidden');
            alert('Logo Background invalid format or Image size is too big.');
            myDropzone.removeFile(file);
        });
    }
};



// Form Toggles
jQuery('.toggle').toggles();

$('#mon-active-toggle').toggles({
    on: parseInt($('.mon-active-toggle').val())    
});

$('#tue-active-toggle').toggles({
    on: parseInt($('.tue-active-toggle').val())    
});

$('#wed-active-toggle').toggles({
    on: parseInt($('.wed-active-toggle').val())    
});

$('#thu-active-toggle').toggles({
    on: parseInt($('.thu-active-toggle').val())    
});

$('#fri-active-toggle').toggles({
    on: parseInt($('.fri-active-toggle').val())    
});

$('#sat-active-toggle').toggles({
    on: parseInt($('.sat-active-toggle').val())    
});

$('#sun-active-toggle').toggles({
    on: parseInt($('.sun-active-toggle').val())    
});

$('#ph-active-toggle').toggles({
    on: parseInt($('.ph-active-toggle').val())    
});
// Select2
jQuery("#select-basic, #select-multi").select2();
jQuery('#select-search-hide').select2({
    minimumResultsForSearch: -1
});

function format(item) {
    return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
}
    
// This will empty first option in select to enable placeholder
jQuery('select option:first-child').text('');
  
jQuery("#select-templating").select2({
    formatResult: format,
    formatSelection: format,
    escapeMarkup: function(m) { return m; }
});

jQuery(document).ready(function(){
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
        var c = confirm("Continue delete?");
        if(c)
            jQuery(this).closest('tr').fadeOut(function(){
            jQuery(this).remove();
        });
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table tbody tr').hover(function(){
        jQuery(this).find('.table-action-hide a').animate({opacity: 1},100);
    },function(){
        jQuery(this).find('.table-action-hide a').animate({opacity: 0},100);
    });

});

jQuery(document).ready(function(){
    
    jQuery('#basicTable').DataTable({
        responsive: true
    });
    
    var shTable = jQuery('#shTable').DataTable({
        "fnDrawCallback": function(oSettings) {
            jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
        },
        responsive: true
    });
});