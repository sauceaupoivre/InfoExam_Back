$(document).ready(function(){
    $("#code_postal").on('input', function(event){
        event.preventDefault();
        var url = "https://geo.api.gouv.fr/communes?codePostal="+$("#code_postal").val();
        $("#lville li").remove();
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(response)
            {
                response.forEach((item, index) => {
                    $("#lville").append('<li id="'+item.nom+'" class="list-group-item list-group-item-action li-code" >'+item.nom+'</li>');
                    $("#lville").show();
                    })
            },
            error: function(response) {
            }
        });
    });

    $(document).on("click", ".li-code", function(e) {
        $("#ville").val($(this).attr('id'));
        $("#lville").hide();
    });

    $(".img-thumbnail").click(function(){
    // Change src attribute of image

        var src = $(this).attr("src");
        let result = null;
        if($(this).attr("src").includes("thumbnail"))
        {
            result = src.replace("thumbnail","images")
        }

        else
        {
            result=src.replace("images","thumbnail")
        }
        $(this).attr("src", result)
    });
});
