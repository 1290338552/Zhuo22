// JavaScript Document

$.extend({
	//初始化验证规则
	validateRule:function(v,r){
		var text = "";
		switch(r.validate){
				case "require" : 
					if(v.length==0) text = r.msg?r.msg:"不能为空！"; 
					break;				
				case "number" : 
					var p = new RegExp("^[0-9]*$","i");
					if(!p.test(v)) text = "必须为数字！"; 
					break;
				case "letter" : 
					var p = new RegExp("^[a-zA-Z]*$","i");
					if(!p.test(v)) text = "必须为字母！"; 
					break;
				case "cnchar" : 
					var p = new RegExp("^[\\u4e00-\\u9fa5]{0,}$","i");
					if(!p.test(v)) text = "必须为汉字！"; 
					break;
				case "firstAlpha" : 
					var p = new RegExp("^[a-zA-Z]","i");
					if(!p.test(v)) text = r.msg?r.msg:"首位必须为字母！"; 
					break;
				case "alphaNum" :
					var p = new RegExp("[A-Za-z].*[0-9]|[0-9].*[A-Za-z]","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须包含字母和数字！";
					break;
				case "length" :  
					if(v.length<=r.min&&v.length<=r.max) text = r.msg?r.msg:"长度必须为"+r.min+"-"+r.max+"个字符之间！"; 
					break;
				case "email" : 
					var p = new RegExp("\\w[-\\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\\.)+[A-Za-z]{2,14}","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为正确的邮箱格式！";
					break;
				case "phone" : 
					var p = new RegExp("(0?(13|14|15|17|18|19)[0-9]{9})|([0-9-()（）]{7,18})","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为正确的电话格式！";
					break;
				case "idcard" : 
					var p = new RegExp("\\d{17}[\\d|x]|\\d{15}","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为正确的身份证号格式！";
					break;
				case "ip" : 
					var p = new RegExp("(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)\\.(25[0-5]|2[0-4]\\d|[0-1]\\d{2}|[1-9]?\\d)","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为正确的IP地址格式！";
					break;
				case "integer" : 
					var p = new RegExp("-?[1-9]\\d*","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为整数！";
					break;
				case "float" : 
					var p = new RegExp("-?([1-9]\\d*.\\d*|0.\\d*[1-9]\\d*)","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为浮点数！";
					break;
				case "date" : 
					var p = new RegExp("\\d{4}(\\-|\\/|.)\\d{1,2}\\1\\d{1,2}|\\d{4}年\\d{1,2}月\\d{1,2}日","i");
					if(!p.test(v)) text = r.msg?r.msg:"必须为正确的日期格式！";
					break;	
				default :
					var p = new RegExp(r.regexp,"i");
					if(!p.test(v)) text = r.msg;
			}; // end switch(this.validate)
			return text;
	},
	//执行验证规则 
	exeValidate:function(n,v,o){
		if(!o) return false;
		v = $.trim(v);
		var text = "";
		$.each(o, function() { 
			text = $.validateRule(v,this);//初始化验证规则
			if(text!=="") return false; //text不为空，表示数据有错，跳出each循环
		}); // end $.each(o, function()
		var p = $('[name='+n+']');
		//循环找到包含类input-group的标签
		while(p[0].className.indexOf("input-group")<0){
			p = p.parent();
		}
		var i = p.find('i[data-toggle="tooltip"]');
		i.tooltip('destroy');//销毁“*”上面的提示信息
		if(text!==""){
			p.removeClass('has-success');
			p.addClass('has-error');
			i.tooltip({
				placement: 'right',tipClass:'tooltip-danger',title:text
			}).tooltip('show');
			return false;
		}
		else{
			p.removeClass('has-error');
			p.addClass('has-success');
			return true;
		}
	},
	//获得标签的值
	getCheckboxSel:function(n){
		var o = $('[name='+n+']');
		var v = '';
		if(o.prop("tagName").toLowerCase()=="input"){
			if(o.attr("type").toLowerCase()=="text"){
				v = o.val();
			}
			else if(o.attr("type").toLowerCase()=="password"){
				v = o.val();
			}
			else if(o.attr("type").toLowerCase()=="checkbox"){
				$('input[name='+n+']:checked').each(function(i, n){ 
						v += (v==""?"":",")+$(this).val();
				});
			}
			else if(o.attr("type").toLowerCase()=="radio"){
				v = $('[name='+n+']:checked').val();
			}
		}
		else{
			v = o.val();
		}
		return v;
	},
});

//表单验证
$.fn.validateForm = function(options) { 
	var isSubForm = true;
	$.each(options, function(n) { 
		var v = $.getCheckboxSel(n);
		var result = $.exeValidate(n,v,options[n]);
		isSubForm = !isSubForm?isSubForm:result;
	});  //end $.each(arr, function()
	return isSubForm;
}

//初始化表单验证
$.fn.initValidateForm = function(options){
	$.each(options, function(n) { 
		var obj = $('[name='+n+']');
		var tag = obj.prop("tagName").toLowerCase();
		 switch(tag){
				case "input" : 
					switch(obj.attr("type").toLowerCase()){
						case "text" : 
							obj.keyup(function(){
									if($(this).is(":focus")) $.exeValidate(this.name,$(this).val(),options[this.name]);
							});
							break;
						case "password" : 
							obj.keyup(function(){
									if($(this).is(":focus")) $.exeValidate(this.name,$(this).val(),options[this.name]);
							});
							break;
						case "password" : 
							obj.keyup(function(){
									if($(this).is(":focus")) $.exeValidate(this.name,$(this).val(),options[this.name]);
							});
							break;
						case "checkbox" : 
							obj.change(function(){
								$.exeValidate(this.name,$.getCheckboxSel(n),options[this.name]);
							});
							break;
						case "radio" : 
							obj.change(function(){
								$.exeValidate(this.name,$.getCheckboxSel(n),options[this.name]);
							});
							break;
					};//end switch(obj.attr("type").toLowerCase())
					break;
				case "select" : 
					obj.change(function(){
						$.exeValidate(this.name,$(this).val(),options[this.name]);
					});
					break;
		 }; //end switch(tag)
	}); //end $.each(options, function(n)
};

//将json对象赋值给form表单
$.fn.initForm=function(options){  
	//默认参数  
	var defaults = {  
			jsonValue:options,  
			isDebug:false   //是否需要调试，这个用于开发阶段，发布阶段请将设置为false，默认为false,true将会把name value打印出来  
	}  
	//设置参数  
	var setting = defaults;  
	var form = this;  
	jsonValue = setting.jsonValue;  
	//如果传入的json字符串，将转为json对象  
	if($.type(setting.jsonValue) === "string"){  
			jsonValue = $.parseJSON(jsonValue);  
	}  
	//如果传入的json对象为空，则不做任何操作  
	if(!$.isEmptyObject(jsonValue)){  
			var debugInfo = "";  
			$.each(jsonValue,function(key,value){  
					//是否开启调试，开启将会把name value打印出来  
					if(setting.isDebug){  
							alert("name:"+key+"; value:"+value);  
							debugInfo += "name:"+key+"; value:"+value+" || ";  
					}  
					var formField = form.find("[name='"+key+"']");  
					if($.type(formField[0]) === "undefined"){  
							if(setting.isDebug){  
									alert("can not find name:["+key+"] in form!!!");    //没找到指定name的表单  
							}  
					} else {  
							var fieldTagName = formField[0].tagName.toLowerCase();  
							if(fieldTagName == "input"){  
									if(formField.attr("type") == "radio"){  
											$("input:radio[name='"+key+"'][value='"+value+"']").attr("checked","checked");  
									} else {  
											formField.val(value);  
									}  
							} else if(fieldTagName == "select"){  
									//do something special  
									formField.val(value);  
							} else if(fieldTagName == "textarea"){  
									//do something special  
									formField.val(value);
							} else {  
									formField.val(value);  
							}  

					}  
			})  
			if(setting.isDebug){  
					alert(debugInfo);  
			}  
	}  
	return form;    //返回对象，提供链式操作  
};
//初始化表单数据
$.fn.initFormData = function(id,url){
	var obj=this;
	$.ajax({
		url:url,
		async:true,
		type:"POST",
		data:{id:id},
		success:function(data){
			if($.type(data) === "string"){  
					data = $.parseJSON(data);  
			} 
			//data = JSON.parse(data);
			$(obj).initForm(data);
		}
	});
}