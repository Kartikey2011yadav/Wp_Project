$(document).ready(function()
{   
    $("#form1").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method:"post",
            url: "search.php",
            data:$(this).serialize(),
            datatype:"text",
            success:function(Result)
            {
                $("#prev").html(Result);
            }
        });
    });
    $("#form2").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method:"post",
            url: "filter.php",
            data:$(this).serialize(),
            datatype:"text",
            success:function(Result)
            {
                $("#prev").html(Result);
            }
        });
    });

    $("#form4").submit(function(e)
    {
        e.preventDefault();
        $.ajax(
        {
            method:"post",
            url: "filterdues.php",
            data: $(this).serialize(),
            datatype: "text",
            success: function(Result)
            {
                $("#prev").html(Result);
            }
        });
    });
    
    // $("#nolib").click(function(e)
    // {
    //     e.preventDefault();
    //     $.ajax(
    //     {
    //         method:"get",
    //         url: "nolib.php",
    //         data:$(this).serialize(),
    //         datatype:"text",
    //         success:function(Result)
    //         {
    //             $("body").html(Result);
    //         }
    //     });
    // });
});