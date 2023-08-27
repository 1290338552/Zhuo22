
//将表单序列化为JSON对象
$.fn.serializeObject = function() {  
		var o = {};  
		var a = this.serializeArray();  
		$.each(a, function() {  
				if (o[this.name]) {  
						if (!o[this.name].push) {  
								o[this.name] = [ o[this.name] ];  
						}  
						o[this.name].push(this.value || '');  
				} else {  
						o[this.name] = this.value || '';  
				}  
		});  
		return o;  
} 


/**
 * 默认提示框，有灰色遮罩，关闭后执行回调函数。
 * @param title 标题
 * @param msg 提示信息
 * @param theme 主题编号
 * @param icon 图标
 * @param timelen 显示时长
 * @param callbackFn 回调函数
 */
function showMsg(title='提示',msg='',theme = 0,icon='frown',timelen=3,callbackFn=null) {
	var color = 'default';
	switch (theme) {
		case 1 : color = 'primary';break;
		case 2 : color = 'success';break;
		case 3 : color = 'info';break;
		case 4 : color = 'warning';break;
		case 5 : color = 'danger';break;
		case 6 : color = 'important';break;
		case 7 : color = 'special';break;
	}
	var mtMsg = new $.zui.Messager('<i class="icon icon-'+icon+'"></i> '+title+'：'+msg, {
		type: color, // 定义颜色主题
		time:60000,
		close: false,
	}).show();
	setTimeout(function () {
		mtMsg.hide();
		if(callbackFn) callbackFn();
	}, timelen * 1000);
}