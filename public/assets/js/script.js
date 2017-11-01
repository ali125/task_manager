var struct_count = 0;

$(".users-project-box li").on('click', function(e){
    var image = $(this).find('img').attr('src');
    var popover_html = '<div class="popover user-project-box" role="tooltip">';
    popover_html += '<div class="arrow"></div>';
    popover_html += '<div class="user-content">';
    popover_html += '<img src="'+image+'" />';
    popover_html += '</div>';
    popover_html += '<h4 class="popover-title"></h4>';
    popover_html += '</div>';

    $(this).popover({
        template: popover_html
    });
});

$(".project-box .actions-box-project ").on('hover', function(){
    $(this).tooltip();
});

// Project Structure
$('.structures-container ').on('click', '.add_new_option', function(e){
    e.preventDefault();
    if($(".options-structure .option-structure").length <= 9){
        var html_input = '<div class="row m-rl-0 form-group option-structure">';
        html_input += '<div class="col-xs-8 col-sm-4 ">';
        html_input += '<input type="text" class="form-control" name="struct['+struct_count+'][option][]" placeholder="option value" />';
        html_input += '</div><button class="btn btn-danger remove_option"><span class="fa fa-minus"></span></button>';
        html_input += '</div>';
        var options_structure = $(this).parentsUntil(".options-structure").parent()[0];
        $(options_structure).prepend(html_input)
    }else{
        alert('Maximum count of options is 10 ');
    }

});
$('.structures-container').on('click', '.remove_option', function(e){
    e.preventDefault();
     $(this).parent().remove();
});

$(".structures-container").on('change', '.structure select', function(){
    var show_form = true;
    var html_input = '<div class="options-structure">';
    html_input += '<div class="row m-rl-0 form-group option-structure">';
    html_input += '<div class="col-xs-8 col-sm-4 ">';
    switch($(this).val()){
        case 'select':
        case 'radio':
        case 'checkbox':
            html_input += '<input type="text" class="form-control" name="struct['+struct_count+'][option][]" placeholder="option value" />';
        break;
        default:
            show_form = false;
    }
    html_input += '</div>';
        
    html_input += '</div>';
    html_input += '<div class="row m-rl-0">';
    html_input += '<div class="col-xs-8 col-sm-4 ">';
    html_input += '<button class="btn btn-success add_new_option">add option <span class="fa fa-plus"></span></button>';
    html_input += '</div></div></div>';

    var parentStructure = $(this).parentsUntil('.structure').parent()[0];
    $(parentStructure).find('.options-structure').remove();
    if(show_form)
        $(parentStructure).append(html_input);
});



$(".structures-container").on('click', '.remove_structure', function(e){
    e.preventDefault();
    $(this).parentsUntil(".structure").parent().remove();
});
$(".structures-container").on('click', '.add_new_structure', function(e){
    e.preventDefault();
    struct_count = $('.structures-container .structure').length + 1;
    if( struct_count  < 9){
        var html_struct = '<div class="structure"><div class="form-group row m-rl-0 ">';
        html_struct += '<div class="col-xs-12 col-sm-5">';
        html_struct += '<label for="title1">Title</label>';
        html_struct += '<input type="text" name="struct['+struct_count+'][title]" class="form-control" id="title1" placeholder="Example: End Date">';
        html_struct += '</div><div class="col-xs-12 col-sm-5">';
        html_struct += '<label for="type1">Type</label>';
        html_struct += '<select class="form-control selecting-type" name="struct['+struct_count+'][type]" id="type1" >';
        html_struct += '<option value="text"> Text </option>';
        html_struct += '<option value="select"> Select </option>';
        html_struct += '<option value="radio"> Radio </option>';
        html_struct += '<option value="checkbox"> CheckBox </option>';
        html_struct += '<option value="textarea"> Textarea </option>';
        html_struct += '<option value="fileuploader"> File Uploader </option>';
        html_struct += '<option value="date"> Date </option>';
        html_struct += '<option value="number"> Number </option>';
        html_struct += '</select></div>';
        html_struct += '<input type="hidden" class="struct-name" name="struct['+struct_count+'][name]" data-key="'+struct_count+'" value="text_'+struct_count+'" />';
        html_struct += '<div class="col-xs-12 col-sm-2"><label></label>';
        html_struct += '<div><button class="btn btn-danger remove_structure"><span class="fa fa-minus"></span></button></div>';
        html_struct += '</div></div></div>';
        $(".structures-container").append(html_struct);
    }else{
        alert('Maximum count of structures is 10 ');
    }
});

/* Bootstrap Js default */
$(function () {
  // $('[data-toggle="popover"]').popover();
//    $('[data-toggle="tooltip"]').tooltip()
})

$(".structures-container").on('change', '.selecting-type' , function(){
    var type = $(this).val();
    console.log(type);
    var name = $(this).parentsUntil(".structure").find(".struct-name");
    var key = $(name).data('key');
    $(name).val(type+'_'+key);
});