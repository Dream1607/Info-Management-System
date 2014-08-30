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
    $("#student").load(url);
}