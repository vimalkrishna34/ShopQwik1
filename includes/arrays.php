<?php
$malls = [
    // Hyderabad Malls
    ['mall_id' => 1, 'name' => 'City Center Mall', 'location' => 'Hyderabad'],
    ['mall_id' => 2, 'name' => 'Inorbit Mall', 'location' => 'Hyderabad'],
    ['mall_id' => 3, 'name' => 'GVK One Mall', 'location' => 'Hyderabad'],
    ['mall_id' => 4, 'name' => 'Manjeera Mall', 'location' => 'Hyderabad'],
    ['mall_id' => 5, 'name' => 'Forum Sujana Mall', 'location' => 'Hyderabad'],
    ['mall_id' => 6, 'name' => 'Sarath City Capital Mall', 'location' => 'Hyderabad'],

    // Bangalore Malls
    ['mall_id' => 7, 'name' => 'Forum Mall', 'location' => 'Bangalore'],
    ['mall_id' => 8, 'name' => 'Orion Mall', 'location' => 'Bangalore'],
    ['mall_id' => 9, 'name' => 'Phoenix Marketcity', 'location' => 'Bangalore'],
    ['mall_id' => 10, 'name' => 'Garuda Mall', 'location' => 'Bangalore'],
    ['mall_id' => 11, 'name' => 'UB City', 'location' => 'Bangalore'],
    ['mall_id' => 12, 'name' => 'Mantri Square Mall', 'location' => 'Bangalore'],

    // Delhi Malls
    ['mall_id' => 13, 'name' => 'Select Citywalk', 'location' => 'Delhi'],
    ['mall_id' => 14, 'name' => 'DLF Promenade', 'location' => 'Delhi'],
    ['mall_id' => 15, 'name' => 'Pacific Mall', 'location' => 'Delhi'],
    ['mall_id' => 16, 'name' => 'Ambience Mall', 'location' => 'Delhi'],
    ['mall_id' => 17, 'name' => 'City Square Mall', 'location' => 'Delhi'],
    ['mall_id' => 18, 'name' => 'V3S Mall', 'location' => 'Delhi'],

    // Mumbai Malls
    ['mall_id' => 19, 'name' => 'Phoenix Marketcity', 'location' => 'Mumbai'],
    ['mall_id' => 20, 'name' => 'R City Mall', 'location' => 'Mumbai'],
    ['mall_id' => 21, 'name' => 'Oberoi Mall', 'location' => 'Mumbai'],
    ['mall_id' => 22, 'name' => 'Infinity Mall', 'location' => 'Mumbai'],
    ['mall_id' => 23, 'name' => 'High Street Phoenix', 'location' => 'Mumbai'],
    ['mall_id' => 24, 'name' => 'Atria Mall', 'location' => 'Mumbai'],
];

$shops = [
    ['shop_id' => 1, 'mall_id' => 1, 'name' => 'ElectroWorld'],
    ['shop_id' => 2, 'mall_id' => 1, 'name' => 'Fashion Hub'],
    ['shop_id' => 3, 'mall_id' => 7, 'name' => 'Gadget Plaza'], // Updated to Bangalore's Forum Mall for variety
];

$products = [
    ['product_id' => 1, 'shop_id' => 1, 'name' => 'iPhone 14', 'price' => 79999, 'description' => 'Latest iPhone model'],
    ['product_id' => 2, 'shop_id' => 2, 'name' => 'Levi’s Jeans', 'price' => 2999, 'description' => 'Premium denim jeans'],
    ['product_id' => 3, 'shop_id' => 3, 'name' => 'Samsung TV', 'price' => 45999, 'description' => '55-inch Smart TV'],
];
?>
