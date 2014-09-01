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
    $("#mytableChecklist").load(url);
}

function getUrlParam(name)
{
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r!=null) return unescape(r[2]); return null; //返回参数值
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
    $("#mytable").load("getStudent.php");
    
    $("tbody").find("tr").each(function(){
        var row = $(this)
        student = $(this).children('td').eq(0).text()
        activity = getUrlParam('activity')
        $.post("postCheckList.php",
        {
          student: student,
          activity: activity
        },
        function(data){
            if(data == 1)
            {
                row.children('td').children('input').attr("checked",'true')
            }
        });
    });
    
    $(":checkbox").click(function(){
        status = $(this).is(':checked')
        student = $(this).parent('td').parent('tr').children('td').eq(0).text();
        activity = getUrlParam('activity')
        $.post("postCheckList.php",
        {
          student: student,
          activity: activity,
          status: status
        });
    });
    
    $(".select").change(function(){
        url=showStudent(true);
        $("#mytable").load(url);
    });
    $("#name").on('input',function(){  
        url=showStudent(true);
        $("#mytable").load(url);
    });
    $(document).keydown(function(event) {
        if(event.keyCode==13)
            {
                url=showActivity(false);
                $("#mytable").load(url);
            }
    });
    $("#confirm").click(function(){
        url=showStudent(false);
        $("#mytable").load(url);
    });
});
