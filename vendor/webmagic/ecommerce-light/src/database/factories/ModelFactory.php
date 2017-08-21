<?php

use IvanLemeshev\Laravel5CyrillicSlug\SlugFacade as Slug;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/**
 * Categories
 */
$factory->define(\Webmagic\EcommerceLight\Category\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $name = $faker->word,
        'slug' => Slug::make($name),
        'title' => $faker->sentence(6),
        'description' => $faker->text(),
        'img' => $faker->imageUrl(640,480)
    ];
});

$factory->defineAs(\Webmagic\EcommerceLight\Category\Category::class, 'main', function () use ($factory) {
    $category = $factory->raw(\Webmagic\EcommerceLight\Category\Category::class);

    return array_merge($category, ['parent_id' => 0]);
});



/**
 * Products
 */
$factory->define(\Webmagic\EcommerceLight\Product\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $name = $faker->word,
        'slug' => Slug::make($name),
        'active' => true,
        'article' => $faker->sentence(6),
        'price' => $faker->numberBetween(100, 1000),
        'description' => $faker->text(),
        'main_image' => $faker->imageUrl(640,480)
    ];
});


/**
 * OptionGroup
 */
$factory->define(\Webmagic\EcommerceLight\Filtering\OptionGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'title' => $faker->word,
    ];
});

/**
 * Filter
 */
$factory->define(\Webmagic\EcommerceLight\Filtering\Filter::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});


/**
 * Option
 */
$factory->define(\Webmagic\EcommerceLight\Filtering\Option::class, function (Faker\Generator $faker) {
    return [
        'value' => $faker->word
    ];
});

