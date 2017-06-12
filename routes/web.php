<?php

Route::get('test', function() {
    app(ArticleRepository::class);
});

Route::get('login', 'LoginController@showLoginForm');
Route::post('login', 'LoginController@postLogin');
Route::get('logout', 'LoginController@getLogout');

Route::get('', 'ArticlesController@showArticles');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::post('articles', 'ArticlesController@storeArticle');
    Route::get('articles/create', 'ArticlesController@showCreateArticle');

    Route::put('articles/{article}', 'ArticlesController@updateArticle');
    Route::get('articles/{article}/edit', 'ArticlesController@showEditArticle');
});

Route::get('articles', 'ArticlesController@showArticles');
Route::get('articles/{article}', 'ArticlesController@showArticle');
Route::post('articles/{article}/comment', 'ArticlesController@storeComment');
Route::get('categories/{category}', 'CategoriesController@showCategories');


