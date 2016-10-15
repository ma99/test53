<template>
    <div class="container">
            <div class="well well-sm">
                <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="icon-addon addon-md">
                            <input id="modal" type="text" placeholder="What are you looking for?" class="form-control" @keyup.esc="close" v-model="query">
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="search()" v-if="!loading">Search!</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
                    </div>
                </div>
            </div>
          
           
            <!-- Modal -->
            <div class="modal" id="myModal" v-if="modal">
                <div class="modal-content">
                    <div class="circle">
                        <span class="close" data-toggle="tooltip" data-placement="top" title="Press esc to close" @click="close">x</span>                  
                    </div>    
                    
                    <div class="alert alert-danger" role="alert" v-if="error">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        {{ error }}
                    </div>

                    <div id="products" class="row list-group">
                        <div class="item col-xs-4 col-lg-4" v-for="product in products">
                            <div class="thumbnail">
                                <img class="group list-group-image" :src="product.image" :alt="product.title" />
                                
                                <div class="caption">
                                    <h4 class="group inner list-group-item-heading">{{ product.title }}</h4>
                                    <p class="group inner list-group-item-text">{{ product.description }}</p>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <p class="lead">${{ product.price }}</p>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <a class="btn btn-success" href="#">Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>          
            </div> 
    </div>
</template>

<script>
    module.exports = {
        data: function () {
            return {
              products: [],
              loading: false,
              error: false,
              query: '',
              modal: false,
            };
        },
        mounted() {
            console.log('Component ready.');
        },
        watch: {
            // whenever query changes, this function will run
            query: function (newQuery) {
              
              //this.showModal();

              this.search();

              console.log('search');
            }
        },
        methods: {
            close: function(){
                this.modal = false;
                //this.query = '';
            },
            search: _.debounce(
                function() {
                    var vm = this;
                    //var this = this;
                    // Clear the error message.
                    vm.error = '';
                    // Empty the products array so we can fill it with the new products.
                    vm.products = [];
                    vm.modal = false;
                   // if (vm.query.length == 0) {
                    if (vm.query == null || vm.query == "") {
                        //vm.modal = false;
                        return;
                    }
                    // Set the loading property to true, this will display the "Searching..." button.
                    vm.loading = true;

                    // Making a get request to our API and passing the query to it.
                    vm.$http.get('/api/search?q=' + vm.query).then((response) => {
                        // If there was an error set the error message, if not fill the products array.
                        response.body.error ? vm.error = response.body.error : vm.products = response.body;
                        // The request is finished, change the loading to false again.
                        vm.loading = false;
                        vm.modal = true;

                        // if (vm.query.length > 0 && vm.modal == false) {
                        //     vm.modal = true;
                        // }
                        
                        // Clear the query.
                        //vm.query = '';
                    });                    
                },
                500       // This is the number of milliseconds we wait for the user to stop typing.
            )    
        }
    }    
</script>
<style>
 /* The Modal (background) */
.modal {
    display: block; 
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 150px auto; /* 15% from the top and centered */
    /*padding: 20px;*/
    padding: 35px 20px 2px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

  /* circle*/
 .circle {
    float: right;
    margin-top: -28px;
    position: relative;
    width: 24px; 
    height: 24px; 
    background: #ebccd1; 
    border-radius: 12px; 
    -moz-border-radius: 15px; 
    -webkit-border-radius: 15px; 
    
}
/* The Close Button */
.close {
    color: #aaa;
    /*float: right;*/
    margin-left: 7px;
    font-size: 20px;
    font-weight: bold;
    position: absolute;
    /*margin-top: -18px;*/
}    

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
