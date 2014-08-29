function showActivity(blur)
{
    var url="getActivity.php"
    type = document.getElementById("type").value
    department = document.getElementById("department").value
    name = document.getElementById("name").value
    url=url+"?type="+type+"&department="+department+"&name="+name
    url=url+"&sid="+Math.random()
    
    if(!blur)
    {
        url=url+"&blur=false"
    }
    return url
}

$(document).ready(function(){
    $("#activity").load("getActivity.php");
    $(".select").change(function(){
        url=showActivity(true);
        $("#activity").load(url);
    });
    $("#name").on('input',function(){  
        url=showActivity(true);
        $("#activity").load(url);
    });
    $("#name").keyup(function(){
        if(event.keyCode==13)
        {
            url=showActivity(false);
            $("#activity").load(url);
        }
    });
    $("#confirm").click(function(){
        url=showActivity(false);
        $("#activity").load(url);
    });
});
