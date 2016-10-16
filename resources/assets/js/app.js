
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('search', require('./components/Search.vue'));

const app = new Vue({
    el: '#app'
});

// working
window.onclick = function(e){
			e.preventDefault();
	 		
	 		var child = app.$refs.foo;
	 		//console.log(child.error) // accessing the component data 
	 		
	 		// Method 1
	 		/*** 
	 		let target = e.srcElement.id;
	 		console.log(target);
	 		if (target === 'myModal') { //your id
	 			child.close();
	 		}
	 		*/
			console.log(e.target.id);
	 		
	 		// Method 2
	 		if (e.target.id === 'myModal') { //your id
	 			child.close(); // accessing the component method
			}
			
	 	} 
	 	//console.log('mmmtest');
	 	//console.log(lastClicked);

