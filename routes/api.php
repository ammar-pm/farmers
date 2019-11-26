<?php

Route::group([
    'prefix' => 'v1',
    'namespace' => 'API',
    'middleware' =>  ['api']
], function () {
    Route::resource('datasets', 'DatasetController');
    Route::get('datasets/chart', 'DatasetController@chart');
    Route::get('datasets/get_sorted_datasets/{sort_option}/{sort_option_type}', 'DatasetController@get_sorted_datasets');
    Route::post('datasets/get_searched_datasets', 'DatasetController@get_searched_datasets');
    Route::post('files/get_searched_files', 'FileController@get_searched_files');
    Route::post('dataset/save', 'DatasetController@save');
    Route::post('dataset/updatePreviewImage', 'DatasetController@updatePreviewImage');
    Route::get('datasets/preview/{id}', 'DatasetController@preview');

    Route::post('files/chartjs', 'FileController@charget_searched_datasetstjs');
    Route::get('files/highchart/{id}', 'FileController@highchart');
    Route::get('files/plotly_map/{id}/{scale}', 'SecondFileController@plotly_map');
    Route::post('files/plotly_bubble', 'BubbleFileController@plotly_bubble');
    Route::post('files/plotly_map2', 'MapFileController@plotly_map');
    Route::post('files/highchart2', 'HighChartFileController@highchart');
    Route::post('files/chartjs2', 'ChartJSFileController@chartjs');
    Route::post('files/saveVizabiOptions', 'FileController@saveVizabiOptions');
    Route::post('files/getVizabiOptions', 'FileController@getVizabiOptions');

    Route::get('files/update_json_row/{file_id}/{changed_row}', 'JSonFileController@update_json_row');
    Route::get('files/delete_json_row/{file_id}/{uid}', 'JSonFileController@delete_json_row');
    Route::get('files/get_json_all_row_qry2/{file_id}', 'JSonFileController@get_json_all_row_qry2');
    Route::get('files/get_json_file_data/{file_id}', 'JSonFileController@get_json_file_data');
    Route::get('files/get_json_dim_data/{file_id}', 'JSonFileController@get_json_dim_data');
    Route::get('files/get_json_aggr_data/{file_id}', 'JSonFileController@get_json_aggr_data');
    Route::get('files/get_json_years_data/{file_id}', 'JSonFileController@get_json_years_data');
    Route::get('files/does_file_have_a_dataset/{file_id}/{lang}', 'FileController@does_file_have_a_dataset');
    Route::get('favorite_api/{id}/{userid}', 'FavoriteController@favorite_api');

    Route::resource('periods', 'PeriodController');
    Route::resource('topics', 'TopicController');
    Route::get('topicsbylang/{lang}', 'TopicController@topicsbylang');
    Route::get('def_governorates/{lang}', 'GovernorateController@def_governorates');
    Route::resource('governorates', 'GovernorateController');
    Route::resource('indicators', 'IndicatorController');
    Route::resource('files', 'FileController');
    Route::get('get_related_datasets', 'DatasetController@get_related_datasets');
    Route::get('files/bytopic/{topic_id}', 'FileController@bytopic');

});

