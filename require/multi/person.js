//自定义一个js文件，内部编写一个类（构造函数）
(function(){
  function	Person(){
  		this.name;
  		this.age;
  		this.sayHi=function(){
  			console.log('我叫'+this.name+'今年'+this.age+'岁');
  		}
	}
	p = new Person();
	//在person.js中增加判断，如果使用的是模块方式
	//通过判断define是不是函数，来确定要不要定义模块
	if(typeof define=='function'){
		define(function(){
			return p;
		})
	}




})()