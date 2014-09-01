function mark(row) 
{
    if (!row.checked) 
    {  
        return;  
    }
    var tr = row.parentNode.parentNode;  
    var tds = tr.cells;  
    var hint = tds[1].innerHTML + "已签到"; 
    alert(hint);
    activity = document.getElementById("activity").innerHTML;
    student = tds[0].innerHTML;
    var url="markStudent.php?activity="+activity+"&student="+student;
    $("#studentChecklist").load(url);
}

function showStudent(blur)
{
    var url="getStudent.php"
    grade = document.getElementById("grade").value
    _class = document.getElementById("class").value
    name = document.getElementById("name").value
    url=url+"?grade="+grade+"&class="+_class+"&name="+name
    url=url+"&sid="+Math.random()
    
    if(!blur)
    {
        url=url+"&blur=false"
    }
    return url
}

$(document).ready(function(){
    $("#student").load("getStudent.php");
    $(".select").change(function(){
        url=showStudent(true);
        $("#student").load(url);
    });
    $("#name").on('input',function(){  
        url=showStudent(true);
        $("#student").load(url);
    });
    $("#name").keyup(function(){
        if(event.keyCode==13)
        {
            url=showStudent(false);
            $("#student").load(url);
        }
    });
    $("#confirm").click(function(){
        url=showStudent(false);
        $("#student").load(url);
    });
});
