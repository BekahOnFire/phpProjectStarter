//
// This Ajax is an interactive popup display for Test Plan script repo scanning.
//
function displayRepoEdit(cmd,path)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
       returnString=xmlhttp.responseText;
       document.getElementById("lightContacts").innerHTML="<div class=\"closeiPop\" ><a onclick=\"document.getElementById('lightContacts').style.display='none';window.location.replace(\'/ontrial/testPlanManager.jsp?RefreshMe=TestRepos\');\" href=\"javascript:void(0)\"><img width=\"23\" height=\"23\" title=\"Click to Close\" src=\"images/close.png\" border=\"0\"></a></div>\n" + "<iframe src=\"/ontrial/popups/manageRepoRecords.jsp?cmd=" + cmd + "&editDirPath=" + path + "\" frameborder=\"0\" width=\"900\" height=\"500\"></iframe>" ;
       document.getElementById('lightContacts').style.display='block';
    }
  }
  xmlhttp.open("GET","/ontrial/popups/manageRepoRecords.jsp",true);
  xmlhttp.send();
}

