$(document).ready(function(){

    $(document).on("change", function(e) {
        if($('#option2').is(':checked'))
        {
            $("#input-manuscrite").show();
            $("#academie").prop('required',true);
            $("#matiere").prop('required',false);
            $("#input-dematerialise").hide();
        }
        else if($('#option1').is(':checked'))
        {
            $("#input-dematerialise").show();
            $("#matiere").prop('required',true);
            $("#academie").prop('required',false);
            $("#input-manuscrite").hide();
        }
    });
});
