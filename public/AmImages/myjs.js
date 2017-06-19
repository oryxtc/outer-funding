function showLocale(objD)

{

	var str,colorhead,colorfoot;

	var yy = objD.getYear();

	if(yy<1900) yy = yy+1900;

	var MM = objD.getMonth()+1;

	if(MM<10) MM = '0' + MM;

	var dd = objD.getDate();

	if(dd<10) dd = '0' + dd;

	var hh = objD.getHours();

	if(hh<10) hh = '0' + hh;

	var mm = objD.getMinutes();

	if(mm<10) mm = '0' + mm;

	var ss = objD.getSeconds();

	if(ss<10) ss = '0' + ss;

	var ww = objD.getDay();
	if  (ww==0)  ww="������";

	if  (ww==1)  ww="����һ";

	if  (ww==2)  ww="���ڶ�";

	if  (ww==3)  ww="������";

	if  (ww==4)  ww="������";

	if  (ww==5)  ww="������";

	if  (ww==6)  ww="������";


	str =  "�����ǣ�"+ yy + "��" + MM + "��" + dd +"&nbsp;&nbsp;"+ ww

	return(str);

}

function tick()

{
	var today;
	today = new Date();
	document.getElementById("time").innerHTML =showLocale(today);
	window.setTimeout("tick()", 1000);
}
function tab_v(id,taba,tabli,num){
	for(var i=1;i<=num;i++){
		if(id==i){
			document.getElementById(taba+i).className="ck";
			document.getElementById(tabli+i).style.display="block";
			$('#more_url').attr('href','/gpzixun/futures')
		}
		else
		{
			// document.getElementById(taba+i).className=" ";
			// document.getElementById(tabli+i).style.display="none";
			$('#more_url').attr('href','/gpzixun/stock')
		}
	}
}
function tab_vc(id,taba,tabli,num){
	for(var i=1;i<=num;i++){
		if(id==i){
			document.getElementById(tabli+i).style.display="block";
		}
		else
		{
			document.getElementById(tabli+i).style.display="none";
		}
	}
}
function showmenu(id){
		document.getElementById("menu_"+id).className="ck";
		document.getElementById("show_"+id).style.display="block";
		}
	function hiddenmenu(id){
		document.getElementById("menu_"+id).className="";
		document.getElementById("show_"+id).style.display="none";
		}
function flashimg(w,h,th,imgs,urls,wzs){
var focus_width=w
var focus_height=h
var text_height=th
var swf_height = focus_height+text_height

var pics=imgs
var links=urls
var texts=wzs
var flashCode = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/hotdeploy/flash/swflash.cab#version=6,0,0,0" width="'+ focus_width +'" height="'+ swf_height +'">';
flashCode = flashCode + '<param name="allowScriptAccess" value="sameDomain"><param name="movie" value="focus2.swf"><param name="quality" value="high"><param name="bgcolor" value="#DEDEDE">';
flashCode = flashCode + '<param name="menu" value="false"><param name=wmode value="opaque">';
flashCode = flashCode + '<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'">';
flashCode=flashCode+' <param name="wmode" value="opaque">';
flashCode = flashCode + '<embed src="focus2.swf" quality="high" wmode="opaque" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'+ focus_width +'" height="'+ swf_height +'" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+focus_width+'&borderheight='+focus_height+'&textheight='+text_height+'"></embed>';
flashCode = flashCode + '</object>';
document.write(flashCode);
	}