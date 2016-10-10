<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;


class SearchController extends Controller
{
     /**
     * Search the products table.
     *
     * @param  Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        // First we define the error message we are going to show if no keywords
        // existed or if no results found.
        $error = ['error' => 'No results found, please try with different keywords.'];

        // Making sure the user entered a keyword.
        if($request->has('q')) {

            // Using the Laravel Scout syntax to search the products table.
            //$posts = Product::search($request->get('q'))->get();
            $products = Product::search($request->input('q'))->get();

            // If there are results return them, if none, return the error message.
            return $products->count() ? $products : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }
}
