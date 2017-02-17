var str = ""; 
document.writeln("<div id=\"_contents\" style=\"padding:6px; background-color:#E3E3E3; font-size: 12px; border: 1px solid #777777;  position:absolute; left:?px; top:?px; width:?px; height:?px; z-index:1; visibility:hidden\">"); 
str += "<select name=\"_year\">";
for (y = 2008; y <= 2012; y++) { 
    str += "<option value=\"" + y + "\">" + y + "</option>"; 
} 
for (y = 2013; y <= 2100; y++) { 
    str += "<option value=\"" + y + "\">" + y + "</option>"; 
} 
str += "</select>年 <select name=\"_moon\">";
for (m = 1; m <= 9; m++) { 
    str += "<option value=\"" + m + "\">" + m + "</option>"; 
} 
for (m = 10; m <= 12; m++) { 
    str += "<option value=\"" + m + "\">" + m + "</option>"; 
} 
str += "</select>月 <select name=\"_day\">"; 
for (d = 1; d <= 9; d++) { 
    str += "<option value=\"" + d + "\">" + d + "</option>"; 
} 
for (d = 10; d <= 31; d++) { 
    str += "<option value=\"" + d + "\">" + d + "</option>"; 
} 
str += "</select>日 <select name=\"_hour\">"; 
for (h = 0; h <= 9; h++) { 
    str += "<option value=\"0" + h + "\">0" + h + "</option>"; 
} 
for (h = 10; h <= 23; h++) { 
    str += "<option value=\"" + h + "\">" + h + "</option>"; 
} 
str += "</select>时 <select name=\"_minute\">"; 
for (m = 0; m <= 9; m++) { 
    str += "<option value=\"0" + m + "\">0" + m + "</option>"; 
} 
for (m = 10; m <= 59; m++) { 
    str += "<option value=\"" + m + "\">" + m + "</option>"; 
} 
str += "</select>分 <select name=\"_second\">"; 
for (s = 0; s <= 9; s++) { 
    str += "<option value=\"0" + s + "\">0" + s + "</option>"; 
} 
for (s = 10; s <= 59; s++) { 
    str += "<option value=\"" + s + "\">" + s + "</option>"; 
} 
str += "</select>秒 <input name=\"queding\" type=\"button\" onclick=\"_select()\" value=\"\u786e\u5b9a\" style=\"font-size:12px\" /></div>"; 
document.writeln(str); 
var _fieldname; 
function _SetTime(tt) { 
    _fieldname = tt; 
    var ttop = tt.offsetTop;    //TT控件的定位点高 
    var thei = tt.clientHeight;    //TT控件本身的高 
    var tleft = tt.offsetLeft;    //TT控件的定位点宽 
    while (tt = tt.offsetParent) { 
        ttop += tt.offsetTop; 
        tleft += tt.offsetLeft; 
    } 
    document.all._contents.style.top = ttop + thei + 4; 
    document.all._contents.style.left = tleft; 
    document.all._contents.style.visibility = "visible"; 
} 
function _select() { 
    _fieldname.value = document.all._year.value + "-" + document.all._moon.value + "-" + document.all._day.value + " " + document.all._hour.value + ":" + document.all._minute.value + ":" + document.all._second.value; 
    document.all._contents.style.visibility = "hidden"; 
} 