<?php 

$array = [
    ['name' => 'John', 'age' => 30],
    ['name' => 'Jane', 'age' => 25],
];
$names = Arr::pluck($array, 'name');
// Result: ['John', 'Jane']



$array = ['name' => 'John', 'age' => 30];
$hasName = Arr::has($array, 'name'); // true
$hasGender = Arr::has($array, 'gender'); // false

$array = ['name' => 'John', 'age' => 30, 'gender' => 'male'];
$filtered = Arr::only($array, ['name', 'age']);
// Result: ['name' => 'John', 'age' => 30]


use Illuminate\Support\Number;
 
$number = Number::spell(102);
// one hundred and two

$number = Number::spell(88, locale: 'ms');
// lapan puluh lapan

use Illuminate\Support\Number;

$currency = Number::currency(1000);
// $1,000.00
 
$currency = Number::currency(1000, in: 'MYR');
// MYR 1,000.00
 
$currency = Number::currency(1000, in: 'MYR', locale: 'ms'); 
// RM 1.000,00

use Illuminate\Support\Number;
 
$size = Number::fileSize(1024);
// 1 KB
 
$size = Number::fileSize(1024 * 1024);
// 1 MB
 
$size = Number::fileSize(1024 * 1024 * 1024 * 16, precision: 2);
// 16.00 GB

return Illuminate\Support\Facades\View::make('profile');
 
return view('profile');