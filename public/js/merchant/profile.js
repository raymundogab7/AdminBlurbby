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
  init: function() {
        this.on("success", function(file) { 
            $('.profile-pic').attr('src', $('.profile-pic').attr('src') + '?' + new Date().getTime());
        });

        this.on("error", function(file) { 
            alert('Invalid format');
            //window.location.reload();
        });
    }
};

Dropzone.options.coverPhoto = {
  init: function() {
        this.on("success", function(file) { 
            $('.cover-photo').attr('style', 'background:url(' + $('.cover-photo').attr('data-src') + '?' + new Date().getTime()+');background-size:cover;');
        });

        this.on("error", function(file) { 
            alert('Invalid format');
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