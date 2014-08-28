var xmlHttp

function GetXmlHttpObject () 
{

   var xmlHttp = null;

   try 
   {
     // Firefox, Opera 8.0+, Safari, IE 7+
     xmlHttp = new XMLHttpRequest();
   } 
   catch (e) 
   {
     // Internet Explorer - old IE - prior to version 7
     try 
     {
        xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
     } 
     catch (e) 
     {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
     }
 }

 return xmlHttp;
}

function showActivity(name,value)
{
    xmlHttp=GetXmlHttpObject()

    if (xmlHttp==null)
    {
        alert ("Browser does not support HTTP Request")
        return
    }
    
    var url="getActivity.php"
    type = document.getElementById("type").value
    department = document.getElementById("department").value
    name = document.getElementById("name").value
    
    url=url+"?type="+type+"&department="+department+"&name="+name
    url=url+"&sid="+Math.random()
    
    xmlHttp.onreadystatechange=stateChanged 
    xmlHttp.open("GET",url,true)
    xmlHttp.send(null)
}

function stateChanged() 
{ 
    if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    { 
        document.getElementById("activity").innerHTML=xmlHttp.responseText 
    } 
}