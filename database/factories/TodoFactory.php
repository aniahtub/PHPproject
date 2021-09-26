<?php
use App\Todo;
use Faker\Factory as Faker;
$factory->define(Todo::class,function(){
    return [
        'name'=> Faker::create()->sentence(3),
        'description'=>Faker::create()->paragraph(4),
        'completed'=>false,
    ];
}
);
