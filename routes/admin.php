<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('lang/{locale}', 'LanguageController@lang')->name('lang');
    Route::group(['middleware' => ['app_activate:get_from_route']], function () {
        Route::get('app-activate/{app_id}', 'SystemController@app_activate')->name('app-activate');
        Route::post('app-activate/{app_id}', 'SystemController@activation_submit');
    });
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/code/captcha/{tmp}', 'LoginController@captcha')->name('default-captcha');
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@submit')->middleware('actch');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
    /*authentication*/

   

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/fcm/{id}', 'DashboardController@fcm')->name('dashboard');     //test route
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
        Route::post('order-stats', 'DashboardController@order_stats')->name('order-stats');
        Route::get('settings', 'SystemController@settings')->name('settings');
        Route::post('settings', 'SystemController@settings_update');
        Route::post('settings-password', 'SystemController@settings_password_update')->name('settings-password');
        Route::get('/get-restaurant-data', 'SystemController@restaurant_data')->name('get-restaurant-data');

        Route::group(['prefix' => 'custom-role', 'as' => 'custom-role.', 'middleware' => ['module:employee_section']], function () {
            Route::get('create', 'CustomRoleController@create')->name('create');
            Route::post('create', 'CustomRoleController@store')->name('store');
            Route::get('update/{id}', 'CustomRoleController@edit')->name('update');
            Route::post('update/{id}', 'CustomRoleController@update');
        });

        Route::group(['prefix' => 'pos', 'as' => 'pos.', 'middleware' => ['module:pos_management']], function () {
            Route::get('/', 'POSController@index')->name('index');
            Route::get('quick-view', 'POSController@quick_view')->name('quick-view');
            Route::post('variant_price', 'POSController@variant_price')->name('variant_price');
            Route::post('add-to-cart', 'POSController@addToCart')->name('add-to-cart');
            Route::post('remove-from-cart', 'POSController@removeFromCart')->name('remove-from-cart');
            Route::post('cart-items', 'POSController@cart_items')->name('cart_items');
            Route::post('update-quantity', 'POSController@updateQuantity')->name('updateQuantity');
            Route::post('empty-cart', 'POSController@emptyCart')->name('emptyCart');
            Route::post('tax', 'POSController@update_tax')->name('tax');
            Route::post('discount', 'POSController@update_discount')->name('discount');
            Route::get('customers', 'POSController@get_customers')->name('customers');
            Route::post('order', 'POSController@place_order')->name('order');
            Route::get('orders', 'POSController@order_list')->name('orders');
            Route::get('order-details/{id}', 'POSController@order_details')->name('order-details');
            Route::get('invoice/{id}', 'POSController@generate_invoice');
            Route::any('store-keys', 'POSController@store_keys')->name('store-keys');
            Route::post('table', 'POSController@getTableListByBranch')->name('table');
            Route::get('clear', 'POSController@clear_session_data')->name('clear');
        });

    

        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['module:business_management']], function () {
            //restaurant-settings
            Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
                Route::get('restaurant-setup', 'BusinessSettingsController@restaurant_index')->name('restaurant-setup')->middleware('actch');
                Route::post('update-setup', 'BusinessSettingsController@restaurant_setup')->name('update-setup')->middleware('actch');

                //app settings
                Route::get('time-schedule', 'TimeScheduleController@time_schedule_index')->name('time_schedule_index');
                Route::post('add-time-schedule', 'TimeScheduleController@add_schedule')->name('time_schedule_add');
                Route::get('time-schedule-remove', 'TimeScheduleController@remove_schedule')->name('time_schedule_remove');

                //location
                Route::get('location-setup', 'LocationSettingsController@location_index')->name('location-setup')->middleware('actch');
                Route::post('update-location', 'LocationSettingsController@location_setup')->name('update-location')->middleware('actch');


            });

            //web-app
            Route::group(['prefix' => 'web-app', 'as' => 'web-app.', 'middleware' => ['module:business_management']], function () {
                Route::get('mail-config', 'BusinessSettingsController@mail_index')->name('mail-config')->middleware('actch');
                Route::post('mail-config', 'BusinessSettingsController@mail_config')->middleware('actch');
                Route::post('mail-send', 'BusinessSettingsController@mail_send')->name('mail-send');

                Route::get('sms-module', 'SMSModuleController@sms_index')->name('sms-module');
                Route::post('sms-module-update/{sms_module}', 'SMSModuleController@sms_update')->name('sms-module-update');

                Route::get('payment-method', 'BusinessSettingsController@payment_index')->name('payment-method')->middleware('actch');
                Route::post('payment-method-update/{payment_method}', 'BusinessSettingsController@payment_update')->name('payment-method-update')->middleware('actch');

                //system-setup
                Route::group(['prefix' => 'system-setup', 'as' => 'system-setup.'], function () {
                    //app settings
                    Route::get('app-setting', 'BusinessSettingsController@app_setting_index')->name('app_setting');
                    Route::post('app-setting', 'BusinessSettingsController@app_setting_update');

                    //clean db
                    Route::get('db-index', 'DatabaseSettingsController@db_index')->name('db-index');
                    Route::post('db-clean', 'DatabaseSettingsController@clean_db')->name('clean-db');

                    //firebase message
                    Route::get('firebase-message-config', 'BusinessSettingsController@firebase_message_config_index')->name('firebase_message_config_index');
                    Route::post('firebase-message-config', 'BusinessSettingsController@firebase_message_config')->name('firebase_message_config');

                    //language
                    Route::group(['prefix' => 'language', 'as' => 'language.', 'middleware' => []], function () {
                        Route::get('', 'LanguageController@index')->name('index');
                        Route::post('add-new', 'LanguageController@store')->name('add-new');
                        Route::get('update-status', 'LanguageController@update_status')->name('update-status');
                        Route::get('update-default-status', 'LanguageController@update_default_status')->name('update-default-status');
                        Route::post('update', 'LanguageController@update')->name('update');
                        Route::get('translate/{lang}', 'LanguageController@translate')->name('translate');
                        Route::post('translate-submit/{lang}', 'LanguageController@translate_submit')->name('translate-submit');
                        Route::post('remove-key/{lang}', 'LanguageController@translate_key_remove')->name('remove-key');
                        Route::get('delete/{lang}', 'LanguageController@delete')->name('delete');
                    });
                });

                //third-party
                Route::group(['prefix' => 'third-party', 'as' => 'third-party.', 'middleware' => ['module:business_management']], function () {
                    //map api
                    Route::get('map-api-settings', 'BusinessSettingsController@map_api_settings')->name('map_api_settings');
                    Route::post('map-api-settings', 'BusinessSettingsController@update_map_api');
                    //Social Icon
                    Route::get('social-media', 'BusinessSettingsController@social_media')->name('social-media');
                    Route::get('fetch', 'BusinessSettingsController@fetch')->name('fetch');
                    Route::post('social-media-store', 'BusinessSettingsController@social_media_store')->name('social-media-store');
                    Route::post('social-media-edit', 'BusinessSettingsController@social_media_edit')->name('social-media-edit');
                    Route::post('social-media-update', 'BusinessSettingsController@social_media_update')->name('social-media-update');
                    Route::post('social-media-delete', 'BusinessSettingsController@social_media_delete')->name('social-media-delete');
                    Route::post('social-media-status-update', 'BusinessSettingsController@social_media_status_update')->name('social-media-status-update');
                    //recaptcha
                    Route::get('recaptcha', 'BusinessSettingsController@recaptcha_index')->name('recaptcha_index');
                    Route::post('recaptcha-update', 'BusinessSettingsController@recaptcha_update')->name('recaptcha_update');

                    //fcm-index
                    Route::get('fcm-index', 'BusinessSettingsController@fcm_index')->name('fcm-index')->middleware('actch');
                    Route::post('update-fcm', 'BusinessSettingsController@update_fcm')->name('update-fcm')->middleware('actch');

                });

            });

            Route::post('update-fcm-messages', 'BusinessSettingsController@update_fcm_messages')->name('update-fcm-messages');

            /*Route::get('currency-add', 'BusinessSettingsController@currency_index')->name('currency-add');
            Route::post('currency-add', 'BusinessSettingsController@currency_store');
            Route::get('currency-update/{id}', 'BusinessSettingsController@currency_edit')->name('currency-update');
            Route::put('currency-update/{id}', 'BusinessSettingsController@currency_update');
            Route::delete('currency-delete/{id}', 'BusinessSettingsController@currency_delete')->name('currency-delete');*/


//            Route::group(['prefix' => '3rdparty-setup', 'as' => 'page-setup.'], function () {
//
//            });

            Route::group(['prefix' => 'page-setup', 'as' => 'page-setup.', 'middleware' => ['module:business_management']], function () {
                Route::get('terms-and-conditions', 'BusinessSettingsController@terms_and_conditions')->name('terms-and-conditions')->middleware('actch');
                Route::post('terms-and-conditions', 'BusinessSettingsController@terms_and_conditions_update')->middleware('actch');

                Route::get('privacy-policy', 'BusinessSettingsController@privacy_policy')->name('privacy-policy')->middleware('actch');
                Route::post('privacy-policy', 'BusinessSettingsController@privacy_policy_update')->middleware('actch');

                Route::get('about-us', 'BusinessSettingsController@about_us')->name('about-us')->middleware('actch');
                Route::post('about-us', 'BusinessSettingsController@about_us_update')->middleware('actch');

                //pages
                Route::get('return-page', 'BusinessSettingsController@return_page_index')->name('return_page_index');
                Route::post('return-page-update', 'BusinessSettingsController@return_page_update')->name('return_page_update');

                Route::get('refund-page', 'BusinessSettingsController@refund_page_index')->name('refund_page_index');
                Route::post('refund-page-update', 'BusinessSettingsController@refund_page_update')->name('refund_page_update');

                Route::get('cancellation-page', 'BusinessSettingsController@cancellation_page_index')->name('cancellation_page_index');
                Route::post('cancellation-page-update', 'BusinessSettingsController@cancellation_page_update')->name('cancellation_page_update');
            });
            Route::get('currency-position/{position}', 'BusinessSettingsController@currency_symbol_position')->name('currency-position');
            Route::get('maintenance-mode', 'BusinessSettingsController@maintenance_mode')->name('maintenance-mode');

        });


        Route::group(['prefix' => 'message', 'as' => 'message.', 'middleware' => ['module:business_management']], function () {
            Route::get('list', 'ConversationController@list')->name('list');
            Route::post('update-fcm-token', 'ConversationController@update_fcm_token')->name('update_fcm_token');
            Route::get('get-firebase-config', 'ConversationController@get_firebase_config')->name('get_firebase_config');
            Route::get('get-conversations', 'ConversationController@get_conversations')->name('get_conversations');
            Route::post('store/{user_id}', 'ConversationController@store')->name('store');
            Route::get('view/{user_id}', 'ConversationController@view')->name('view');
        });

   
    });

    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['module:user_management']], function () {
        Route::get('add', 'UserController@index')->name('add');
        Route::post('store', 'UserController@store')->name('store');
        Route::get('list', 'UserController@list')->name('list');
        Route::get('preview/{id}', 'UserController@preview')->name('preview');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::post('update/{id}', 'UserController@update')->name('update');
        Route::delete('delete/{id}', 'UserController@delete')->name('delete');
        Route::post('search', 'UserController@search')->name('search');
    });
    
    Route::group(['prefix' => 'ads', 'as' => 'ads.', 'middleware' => ['module:ads_management']], function () {
        Route::get('add', 'adsController@index')->name('add');
        Route::post('store', 'adsController@store')->name('store');
        Route::get('list', 'adsController@list')->name('list');
        Route::get('preview/{id}', 'adsController@preview')->name('preview');
        Route::get('edit/{id}', 'adsController@edit')->name('edit');
        Route::post('update/{id}', 'adsController@update')->name('update');
        Route::delete('delete/{id}', 'adsController@delete')->name('delete');
        Route::post('search', 'adsController@search')->name('search');
    });

    Route::group(['prefix' => 'withdrawal', 'as' => 'withdrawal.', 'middleware' => ['module:withdrawal_management']], function () {
        Route::get('list', 'withdrawalController@list')->name('list');
        Route::post('search', 'withdrawalController@search')->name('search');
        Route::post('/admin/withdrawals/update-status', 'WithdrawalController@updateStatus')->name('admin.withdrawals.update-status');

    });
    Route::group(['prefix' => 'transaction', 'as' => 'transaction.', 'middleware' => ['module:transaction_management']], function () {
        Route::get('list', 'transactionController@list')->name('list');
        Route::post('search', 'transactionController@search')->name('search');
    });

    Route::group(['prefix' => 'ads_trans', 'as' => 'ads_trans.', 'middleware' => ['module:ads_trans_management']], function () {
        Route::get('list', 'ads_transController@list')->name('list');
        Route::post('search', 'ads_transController@search')->name('search');
    });

    Route::group(['prefix' => 'notification', 'as' => 'notification.', 'middleware' => ['module:notification_management']], function () {
        Route::get('list', 'notificationController@list')->name('list');
        Route::post('search', 'notificationController@search')->name('search');
        Route::get('add', 'notificationController@index')->name('add');
        Route::post('store', 'notificationController@store')->name('store');
        Route::delete('delete/{id}', 'notificationController@delete')->name('delete');
    });

    Route::group(['prefix' => 'app_update', 'as' => 'app_update.', 'middleware' => ['module:app_update_management']], function () {
        Route::get('add', 'app_updateController@index')->name('add');
        Route::post('store', 'app_updateController@store')->name('store');
        Route::get('list', 'app_updateController@list')->name('list');
        Route::get('preview/{id}', 'app_updateController@preview')->name('preview');
        Route::get('edit/{id}', 'app_updateController@edit')->name('edit');
        Route::post('update/{id}', 'app_updateController@update')->name('update');
        Route::delete('delete/{id}', 'app_updateController@delete')->name('delete');
        Route::post('search', 'app_updateController@search')->name('search');
    });

    Route::group(['prefix' => 'branches', 'as' => 'branches.', 'middleware' => ['module:branches_management']], function () {
        Route::get('add', 'branchesController@index')->name('add');
        Route::post('store', 'branchesController@store')->name('store');
        Route::get('list', 'branchesController@list')->name('list');
        Route::get('preview/{id}', 'branchesController@preview')->name('preview');
        Route::get('edit/{id}', 'branchesController@edit')->name('edit');
        Route::post('update/{id}', 'branchesController@update')->name('update');
        Route::delete('delete/{id}', 'branchesController@delete')->name('delete');
        Route::post('search', 'branchesController@search')->name('search');
    });
    Route::group(['prefix' => 'staffs', 'as' => 'staffs.', 'middleware' => ['module:staffs_management']], function () {
        Route::get('add', 'staffsController@index')->name('add');
        Route::post('store', 'staffsController@store')->name('store');
        Route::get('list', 'staffsController@list')->name('list');
        Route::get('preview/{id}', 'staffsController@preview')->name('preview');
        Route::get('edit/{id}', 'staffsController@edit')->name('edit');
        Route::post('update/{id}', 'staffsController@update')->name('update');
        Route::delete('delete/{id}', 'staffsController@delete')->name('delete');
        Route::post('search', 'staffsController@search')->name('search');
    });
    

    Route::get('list', 'OrderController@list')->name('list');
    Route::post('search', 'OrderController@search')->name('search');
    Route::get('edit/{id}', 'OrderController@edit')->name('edit');
    Route::post('update/{id}', 'OrderController@update')->name('update');
    Route::delete('delete/{id}', 'OrderController@delete')->name('delete');

  
    Route::group(['prefix' => 'publish', 'as' => 'publish.', 'middleware' => ['module:publish_management']], function () {
        Route::get('list', 'PublisherController@list')->name('list');
        Route::get('preview/{id}', 'PublisherController@preview')->name('preview');
        Route::get('edit/{id}', 'PublisherController@edit')->name('edit');
        Route::post('update/{id}', 'PublisherController@update')->name('update');
        Route::delete('delete/{id}', 'PublisherController@delete')->name('delete');
        Route::post('search', 'PublisherController@search')->name('search');
    });
    Route::group(['prefix' => 'app_update', 'as' => 'app_update.', 'middleware' => ['module:app_update_management']], function () {
        Route::get('list', 'app_updateController@list')->name('list');
        Route::get('preview/{id}', 'app_updateController@preview')->name('preview');
        Route::get('edit/{id}', 'app_updateController@edit')->name('edit');
        Route::post('update/{id}', 'app_updateController@update')->name('update');
        Route::delete('delete/{id}', 'app_updateController@delete')->name('delete');
        Route::post('search', 'app_updateController@search')->name('search');
    });

   

    Route::group(['prefix' => 'comment', 'as' => 'comment.', 'middleware' => ['module:comment_management']], function () {
        Route::get('commentlist', 'UserController@Commentlist')->name('commentlist');
        Route::delete('commentdelete/{id}', 'UserController@Commentdelete')->name('commentdelete');
        Route::post('commentsearch', 'UserController@Commentsearch')->name('commentsearch');
    });


});

