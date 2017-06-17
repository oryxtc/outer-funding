function nTabs(thisObj,Num){
if(thisObj.className == "active")return;
var tabObj = thisObj.parentNode.id;
var tabList = document.getElementById(tabObj).getElementsByTagName("li");
for(i=0; i <tabList.length; i++)
{
if (i == Num)
{
thisObj.className = "onk1";
document.getElementById(tabObj+"_Content"+i).style.display = "block";
}else{
tabList[i].className = "unonk1";
document.getElementById(tabObj+"_Content"+i).style.display = "none";
}
}
}




function nTabs2(thisObj,Num){
if(thisObj.className == "active")return;
var tabObj = thisObj.parentNode.id;
var tabList = document.getElementById(tabObj).getElementsByTagName("li");
for(i=0; i <tabList.length; i++)
{
if (i == Num)
{
thisObj.className = "onk2";
document.getElementById(tabObj+"_Content"+i).style.display = "block";
}else{
tabList[i].className = "unonk2";
document.getElementById(tabObj+"_Content"+i).style.display = "none";
}
}
}



function nTabs3(thisObj,Num){
if(thisObj.className == "active")return;
var tabObj = thisObj.parentNode.id;
var tabList = document.getElementById(tabObj).getElementsByTagName("li");
for(i=0; i <tabList.length; i++)
{
if (i == Num)
{
thisObj.className = "onk3";
document.getElementById(tabObj+"_Content"+i).style.display = "block";
}else{
tabList[i].className = "unonk3";
document.getElementById(tabObj+"_Content"+i).style.display = "none";
}
}
}



function nTabs4(thisObj,Num){
if(thisObj.className == "active")return;
var tabObj = thisObj.parentNode.id;
var tabList = document.getElementById(tabObj).getElementsByTagName("li");
for(i=0; i <tabList.length; i++)
{
if (i == Num)
{
thisObj.className = "onk4";
document.getElementById(tabObj+"_Content"+i).style.display = "block";
}else{
tabList[i].className = "unonk4";
document.getElementById(tabObj+"_Content"+i).style.display = "none";
}
}
}