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
            
            if (file.height < 128 && file.width < 128) {
                alert("Image should be at least 128px x 128px");
                window.location.reload();
                return false;
            }
        });
        this.on("success", function(file) { 
            //$('#restaurant_form').submit();
        });

        this.on("complete", function(file) {
            if($('#has_cover_photo').val() == "false"){

                $('#restaurant_form').submit();
            }
        });

        this.on("error", function(file) { 
            alert('Invalid format or Image size is too big.');
            window.location.reload();
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
            if (file.height < 500 && file.width < 500) {
                
                alert("Image should be at least 500px x 500px");
                window.location.reload();
                return false;
            }
        });
        this.on("success", function(file) { 
            //$('#restaurant_form').submit();
        });

        this.on("complete", function(file) {
            $('#restaurant_form').submit();
        });
        
        this.on("error", function(file) { 
            alert('Invalid format or Image size is too big.');
            window.location.reload();
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