//a 依赖 b
//参数3   回调函数中的参数是依赖的模块的返回值  接收的是b模块的返回值
define(['module/b'],function(res){
	return res + 10;
}) 