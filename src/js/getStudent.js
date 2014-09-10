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
    $("#table").load("getStudent.php");
  
    $("select").change(function(){
        url=showStudent(true);
        $("#table").load(url);
    });
    $("#name").on('input',function(){  
        url=showStudent(true);
        $("#table").load(url);
    });
     $(document).keydown(function(event) {
        if(event.keyCode==13)
        {
        url=showStudent(false);
        $("#table").load(url);
    }
    });
    $("#confirm").click(function(){
        url=showStudent(false);
        $("#table").load(url);
    });
});
