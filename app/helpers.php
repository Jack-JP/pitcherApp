<?php

function presentPrice($price){
  return money_format('$%i', $price / 100);
}

function allCategories(){
  return $categories = App\Category::all();
}
