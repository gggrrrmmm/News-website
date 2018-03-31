//AMD ：异步模块加载
//AMD:有两个函数 define（该方法是用来定义模块） 和 require（该方法用来加载模块）
//define 有三个参数  
//define(var1,var2,var3); var1:模块名称（可以省略） 
// var2:依赖关系（如果没有依赖关系可以省略）
// var3:模块实现（回调函数）(该模块要实现的功能编码写在回调函数中)
define(function(){
	console.log('模块a中输出的内容');	
})
// define(function(){
//     console.log('模块a输出的内容');
// })