<template>
    <div class="container">
            <div class="well well-sm">
                <div class="form-group">
                    <div class="input-group input-group-md">
                        <div class="icon-addon addon-md">
                            <input type="text" placeholder="What are you looking for?" class="form-control" v-model="query">
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" @click="search()" v-if="!loading">Search!</button>
                            <button class="btn btn-default" type="button" disabled="disabled" v-if="loading">Searching...</button>
                        </span>
                    </div>
                </div>
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
</template>

<script>
    module.exports = {
        data: function () {
            return {
              products: [],
              loading: false,
              error: false,
              query: '',
            };
        },
        mounted() {
            console.log('Component ready.');
        },
        watch: {
            // whenever query changes, this function will run
            query: function (newQuery) {
                    //if (this.query == null || this.query == "") {
                    /*if (this.query.length <= 2) {
                        console.log('empty textbox');
                        this.error = '';
                        this.error = 'at least 3 char';
                        console.log('clear error');
                        this.products = [];
                        console.log('clear products');
                        return;
                    }*/
              //this.answer = 'Waiting for you to stop typing...'
              this.search();
              console.log('search');
            }
        },
        methods: {
            search: _.debounce(
                function() {
                    var vm = this;
                    //var this = this;
                    // Clear the error message.
                    vm.error = '';
                    // Empty the products array so we can fill it with the new products.
                    vm.products = [];
                    
                   // if (vm.query.length == 0) {
                    if (vm.query == null || vm.query == "") {
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
                        // Clear the query.
                        //vm.query = '';
                    });                    
                },
                500       // This is the number of milliseconds we wait for the user to stop typing.
            )    
        }
    }
</script>
