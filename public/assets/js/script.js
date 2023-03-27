$(document).ready(function(){

    $(document).on("change", function(e) {
        if($('#option2').is(':checked'))
        {
            $(".input-manuscrit").show();
            $(".academie").prop('required',true);
            $(".matiere").prop('required',false);
            $(".input-dematerialise").hide();
        }
        else if($('#option1').is(':checked'))
        {
            $(".input-dematerialise").show();
            $(".matiere").prop('required',true);
            $(".academie").prop('required',false);
            $(".input-manuscrit").hide();
        }
    });
/*
    $("#rienrien").on('input', function(event){
        event.preventDefault();
        var url = "http://localhost/InfoExam_Back/public/api/date/"+$("#date-alerte").val();
        $("#epreuves option").remove();
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                if(response == null)
                {

                }
                else{
                    response.forEach((item, index) => {
                        $("#epreuves").append('<option class="epreuves-option" value="'+item.id+'">'+"Salle : "+ item.salle["nom"] +" | Formation : "+ item.formation["nom"] +" | Concours : "+ item.epreuve["examen_concours"] +" | Epreuve : "+ item.epreuve["epreuve"] +              '</option>');
                        $("#div-epreuves").show();
                    })
                }
            },
            error: function(response) {
            }
        });
    });*/
});
