
function loadXMLDoc() {
    var fname= document.getElementById("fname").value;
    var fgender= document.getElementById("fgender").value;
    var fnumber= document.getElementById("fnumber").value;
    var ftext= document.getElementById("ftext").value;
    var fman= document.getElementById("fman").value;
    if(fname === ""||fgender===""||fnumber===""||ftext===""||fman===""){
        totip("信息不能有空")
    }else{
        if(fname.length>=100){
            totip("姓名字符长度过长")
        }else if(fgender!=="男"&&fgender!=="女"){
            totip("性别为'男'或'女'")
        }else if(!(/^1(3|4|5|7|8)\d{9}$/.test(fnumber))){
            totip("手机号格式错误")
        }else if(ftext.length>=100){
            totip("地址字符长度过长")
        }else if(ftext.length>=3){
            totip("尺寸字符长度过长")
        }else{
            document.getElementById("internetBtnOff").style.display = "block";
            document.getElementById("btn").innerHTML = "提交中...";
            document.getElementById("btn").style.opacity = "0.8";
            var xmlhttp;
            if (window.XMLHttpRequest) {
                //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
                xmlhttp=new XMLHttpRequest();
            }
            else {
                // IE6, IE5 浏览器执行代码
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 ) {
                    document.getElementById("internetBtnOff").style.display = "none";
                    document.getElementById("btn").innerHTML = "提交";
                    document.getElementById("btn").style.opacity = "1";
                    if (xmlhttp.status!=200){
                        totip("提交失败")
                    }
                }
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    console.log(xmlhttp.responseText)
                    if(xmlhttp.responseText==="success"){
                        totip("提交成功")
                    }else{
                        if(xmlhttp.responseText==="errorCopy"){
                            totip("您已提交过!")
                        }else{
                            totip("提交失败")
                        }
                    }
                }
            }
            xmlhttp.open("POST","/mobeilData/php/add.php",true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("fname="+fname+"&fgender="+fgender+"&fnumber="+fnumber+"&ftext="+ftext+"&fman="+fman);
        }
    }
}
function totip(text) {
    document.getElementById("popup_body").style.display = "block";
    document.getElementById("totip").innerHTML = text;
}
function closePopup() {
    document.getElementById("popup_body").style.display = "none";
    document.getElementById("totip").innerHTML = "";
}