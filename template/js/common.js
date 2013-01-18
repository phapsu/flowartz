function add_favorite(contaner, $id, $name){
    $(contaner).html('Saving...');
    $.post("/workshop/add_favorite",{
        id: $id, 
        name: $name
    } ,function(data) {
        $(contaner).html('<img src="<?php echo base_url(); ?>template/images/star.png" />');            
    });
}