<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('congreso', 'MiniappController@login');
Route::post('congreso-menu', 'MiniappController@validateAssistant')->name('login.miniapp');
Route::post('congreso-plano', 'MiniappController@map')->name('plano.miniapp');
Route::get('congreso-plano-full', 'MiniappController@mapFull')->name('planofull.miniapp');


Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', 'HomeController@index')->name('inicio')
->middleware('auth');


//asistant event
Route::patch('assistantEvents/{assistant}', 'AssistantEventController@update')->name('assistantEvents.update');



//external inscription
Route::get('/external-inscription/{event}/{plan}', 'ExternalInscriptionController@create')->name('external-inscription.create');

                //assistants resources controller and routes
                Route::resource('assistants', 'AssistantController', ['except' => 'show','create']);
Route::middleware(['auth'])->group(function(){

               //plans resources controller and routes
        Route::resource('plans', 'PlanController', ['except' => 'show','create','edit']);
                //companies resources controller and routes
        Route::resource('companies', 'CompanyController', ['except' => 'show','create','edit']);

                //hotels resources controller and routes
        Route::resource('hotels', 'HotelController', ['except' => 'show','create','edit']);
                //hotels resources controller and routes
        Route::resource('rooms', 'RoomController', ['except' => 'show','create','edit']);
                //hotels resources controller and routes
        Route::resource('reg_observation', 'RegObservationController', ['except' => 'show','create','edit']);
                //hotels resources controller and routes
        Route::resource('billing_debits', 'BillingDebitsController', ['except' => 'show','create','edit']);
                //trade union argumentation
        Route::resource('trade_union_argumentation', 'TradeUnionArgumentationController', ['except' => 'show','create','edit']);
        
        Route::resource('chapter', 'ChapterController', ['except' => 'show','create','edit']);
                

        // Route::put('assistants/update', 'AssistantController@update')->name('assistants.update')
        // ->middleware('permission_sh:assistants.edit');

            //Afiliaciones
        Route::post('affiliations/store', 'AffiliationsController@store')->name('affiliations.store');
        Route::get('affiliations/estados', 'AffiliationsController@obestados')->name('estados-empresas.get');
        Route::get('affiliations/get-all-states', 'AffiliationsController@getAllStates')->name('estados-empresas.get');
        Route::get('affiliations/changes/{module}/', 'AffiliationsController@getChanges')->name('affiliations-changes.get');
        Route::get('affiliations/company/{id_cmp_state}', 'AffiliationsController@getCompanies')->name('affiliations-getCompanies');
        Route::get('affiliations/get-companies', 'AffiliationsController@getCompaniesApi');
        Route::get('affiliations/companies-by-state/{state_company}', 'AffiliationsController@getCompaniesByState');

//API
        //get assets to normally address
        Route::get('/api/address/get-nomenclatures','AddressController@getNomenclatures');
        Route::get('/api/address/get-digits','AddressController@getDigits');
        Route::get('/api/address/get-add-letters','AddressController@getAddLetters');

        //update print gafete status
        Route::put('update-record-print/{record}', 'RecordController@update')->name('records.update')
                ->middleware('permission_sh:records.edit');

        //update print gafete status
        Route::get('print-gafete/{record}', 'RecordController@printGafete')->name('records.print')
                ->middleware('permission_sh:records.print');

        //update print gafete status
        Route::get('get-data-ass/{record}', 'RecordController@getDataAss')->name('records.getDataAss')
                ->middleware('permission_sh:records.getDataAss');

        //update print gafete status
        Route::get('/printed/{event}/lists', 'RecordController@getPrinted')->name('records.getDataAss')
                ->middleware('permission_sh:records.getDataAss');

        //get the plans list by event
        Route::get('/plans/{event}/lists','DivulgationController@getPlansEvent');
        
        //get the assistants registereds by event
        Route::get('/records/{event}/lists','RecordController@getRecordsEvent');

        // delete a record
        Route::delete('/records/{record}','RecordController@deleteRecord');

        //get companies active in database
        Route::get('/api/get-companies','DivulgationController@getCompanies');

        //get assistants by companies
        Route::get('/api/{company}/assistants-by-companies','DivulgationController@getAssistantsByCompany');

        //get assistants by companies
        Route::get('/api/{event}/get-total-ref','RecordController@getTotalRef');

        //get assistants by companies
        Route::get('/api/{event}/get-plans','DivulgationController@getPlans');

        //get disponibles nights by hotel
        Route::get('/api/{hotel}/get-disponible-nights-by-hotel','RecordController@getDisponibleNightsByHotel');

        //get company states
        Route::get('/api/get-company-states','DivulgationController@getCompanyStates');

        //get events
        Route::get('/api/get-events/{event}','DivulgationController@getEvents');

        //get cities
        Route::get('/api/get-cities/','DivulgationController@getCities');

        //get hotels
        Route::get('/api/get-hotels/','DivulgationController@getHotels');

        //get room types
        Route::get('/api/get-room-types/','DivulgationController@getRoomTypes');

        //get rooms by hotel
        Route::get('/api/{hotel}/get-rooms-by-hotel/','DivulgationController@getRoomsByHotel');

        //create record hosting
        Route::get('/api/{id_assistant}/{id_event}/{id_plan}/{academic_agenda}/{room}/{hotel}/{check_in}/{check_out}/{price}/create-record/','RecordController@createRecord');
        //http://www.colfecar.abytesoluciones.com/api/1009/1/35/1/0/create-record-no-hotel

        //create record hosting whith partner
        Route::get('/api/{id_assistant}/{id_event}/{id_plan}/{academic_agenda}/{room}/{hotel}/{id_assistant_part}/{check_in}/{check_out}/{price}/create-record-with-partner/','RecordController@createRecordPartner');

        //create record 
        Route::get('/api/{id_assistant}/{id_event}/{id_plan}/{academic_agenda}/{price}/create-record-no-hotel/','RecordController@createRecordNoHotel');

        //get assistant in record
        Route::get('/api/{assistant}/{event}/get-user-recorded','DivulgationController@getAssistantRecord');

        //get assistant in by event
        Route::get('/api/{event}/get-assistants-by-event','DivulgationController@getAssistantByEvent');

        //get set entry in record
        Route::get('/api/{assistant}/{event}/entry','DivulgationController@setEntryInRecord');

        //get the assistants registered
        Route::get('/api/{event}/get-assistants-registered','DivulgationController@getAssistantsRegistered');

        // '/api/'+val.record_id+'/'+refMode+'/get-ref-status-by-record'
        Route::get('/api/{user}/{ref_mode}/get-ref-status-by-record','DivulgationController@getRefStatusRecord');

        //get assistant by id
        Route::get('/api/{assistant}/get-reg-by-assistant','DivulgationController@getRegByAssId');

        //get record by id
        Route::get('/api/{record}/get-reg-by-record','DivulgationController@getRegByRecId');

        
        //get assistant by id
        Route::get('/api/{record}/get-observation-rec','DivulgationController@getObservationsByRec');

        //get bills by rec
        Route::get('/api/{record}/get-bills-rec','DivulgationController@getBillByRec');

        //get bills by rec
        Route::get('/api/{bill}/get-debits-rec','DivulgationController@getDebitByRec');

        //get bills by rec
        Route::get('/api/{assistant}/get-partner-data','DivulgationController@getPartnerData');

        //get assistant data to update
        Route::get('/api/{assistant}/get-assistant-update','DivulgationController@getUpdateAssistant');

        //update aswsitant info
        Route::put('/api/assistants/{assistant}','DivulgationController@updateAssistant');

        //change the lunch status
        Route::get('/api/records-lunch-update/{record}/{lucnh}/{value}','RecordController@lunchStatus');

        


        //register the refiger
        Route::get('/api/{ref}/{ref_mode}/{record}/reg-ref','DivulgationController@setRegRef');

        //update plan record
        Route::patch('/update-plan-record/{record}','DivulgationController@updatePlanRecord')->name('update-plan-record.update');

        //update bill price
        Route::patch('/update-bill-price/{bill}','DivulgationController@updateBillPrice')->name('update-bill-price.update');

        //update ref status
        Route::patch('/update-ref/{ref}','DivulgationController@updateRefStatus')->name('update-ref.update');

        //delete a register
        Route::delete('/del-reg/{reg}','DivulgationController@delRegister')->name('del-reg.update');

        //get changes by item
        Route::get('/api/get-changes-by-item/{item}','ChangesController@getChangesByItem')->name('get-changes');

        //get event Types
        Route::get('/api/get-event-types','EventsController@getEventTypes')->name('get-event-types');

        //new event from API
        Route::resource('/api/events', 'EventsController', ['except' => 'show','create']);

        //get chapters
        Route::get('/api/get-chapters','ChapterController@getChapters');

        //get chapter types
        Route::get('/api/get-chapter-types','ChapterController@getChapterTypes');
        //get the company by id to module
        Route::get('/api/company/{company}/get-company','AffiliationsController@getCompanyById');
        //get all users that is active
        Route::get('/api/get-users/','UserController@getUsers');
        //get the changes by month
        Route::get('/api/get-changes-by-month/{currentDate}/{initDate}/{item_id}','ChangesController@getChangesByMonth');
        //get changes by user_id
        Route::get('/api/get-changes-by-user/{user}','ChangesController@getChangesByUser');
        //get company types to API
        Route::get('/api/get-company-types','CompanyTypeController@getCompanyTypes');

    //Chapters
    Route::post('chapter/store', 'ChapterController@store')->name('chapter.store');
            //->middleware('permission_sh:chapter.create');

    Route::get('chapter', 'ChapterController@index')->name('chapter.index')
            ->middleware('permission_sh:chapter.index');

    Route::get('chapter/create', 'ChapterController@create')->name('chapter.create')
            ->middleware('permission_sh:chapter.create');

    Route::put('chapter/{chapter}', 'ChapterController@update')->name('chapter.update');
            //->middleware('permission_sh:chapter.edit');

    Route::get('chapter/{chapter}', 'ChapterController@show')->name('chapter.show')
            ->middleware('permission_sh:chapter.show');

    Route::delete('chapter/{chapter}', 'ChapterController@destroy')->name('chapter.destroy')
            ->middleware('permission_sh:chapter.destroy');

    Route::get('chapter/{chapter}/edit', 'ChapterController@edit')->name('chapter.edit')
            ->middleware('permission_sh:chapter.edit');
    
    Route::get('chapter/{chapter}/get-chapter','ChapterController@getChapter');


//CRUD
        Route::post('affiliations/store', 'AffiliationsController@store')->name('affiliations.store')
                ->middleware('permission_sh:affiliations.create');
            
   Route::get('affiliations', 'AffiliationsController@index')->name('affiliations.index')
           ->middleware('permission_sh:affiliations.index');
   
   Route::get('affiliations/create', 'AffiliationsController@create')->name('affiliations.create')
           ->middleware('permission_sh:affiliations.create');

   Route::put('affiliations/{company}', 'AffiliationsController@update')->name('affiliations.update')
           ->middleware('permission_sh:affiliations.edit');

   Route::get('affiliations/{company}', 'AffiliationsController@show')->name('affiliations.show')
           ->middleware('permission_sh:affiliations.show');

   Route::delete('affiliations/{company}', 'AffiliationsController@destroy')->name('affiliations.destroy')
            ->middleware('permission_sh:affiliations.destroy');

   Route::get('affiliations/{company}/edit', 'AffiliationsController@edit')->name('affiliations.edit')
           ->middleware('permission_sh:affiliations.edit');




    //Roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
            ->middleware('permission_sh:roles.create');

    Route::get('roles', 'RoleController@index')->name('roles.index')
            ->middleware('permission_sh:roles.index');

    Route::get('roles/create', 'RoleController@create')->name('roles.create')
            ->middleware('permission_sh:roles.create');

    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
            ->middleware('permission_sh:roles.edit');

    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
            ->middleware('permission_sh:roles.show');

    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
            ->middleware('permission_sh:roles.destroy');

    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
            ->middleware('permission_sh:roles.edit');
    
    
    
            //Users
    Route::post('users/store', 'UserController@store')->name('users.store')
            ->middleware('permission_sh:users.create');

    Route::get('users', 'UserController@index')->name('users.index')
            ->middleware('permission_sh:users.index');

    Route::get('users/create', 'UserController@create')->name('users.create')
            ->middleware('permission_sh:users.create');

    Route::put('users/{user}', 'UserController@update')->name('users.update')
            ->middleware('permission_sh:users.edit');

    Route::get('users/{user}', 'UserController@show')->name('users.show')
            ->middleware('permission_sh:users.show');

    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
            ->middleware('permission_sh:users.edit');
    
    Route::put('/estado-usuario/{id}/{st}', 'UserController@estadoUsuario')->name('users.status')
            ->middleware('permission_sh:users.status');

                //company_states
    Route::post('company_states/store', 'CompanyStateController@store')->name('company_states.store')
            ->middleware('permission_sh:company_states.create');

    Route::get('company_states', 'CompanyStateController@index')->name('company_states.index')
            ->middleware('permission_sh:company_states.index');

    Route::get('company_states/create', 'CompanyStateController@create')->name('company_states.create')
            ->middleware('permission_sh:company_states.create');

    Route::put('company_states/{company_state}', 'CompanyStateController@update')->name('company_states.update')
            ->middleware('permission_sh:company_states.edit');

    Route::get('company_states/{company_state}', 'CompanyStateController@show')->name('company_states.show')
            ->middleware('permission_sh:company_states.show');

    Route::delete('company_states/{company_state}', 'CompanyStateController@destroy')->name('company_states.destroy')
             ->middleware('permission_sh:company_states.destroy');

    Route::get('company_states/{company_state}/edit', 'CompanyStateController@edit')->name('company_states.edit')
            ->middleware('permission_sh:company_states.edit');


                //company_types
    Route::post('company_types/store', 'CompanyTypeController@store')->name('company_types.store')
            ->middleware('permission_sh:company_types.create');

    Route::get('company_types', 'CompanyTypeController@index')->name('company_types.index')
            ->middleware('permission_sh:company_types.index');

    Route::get('company_types/create', 'CompanyTypeController@create')->name('company_types.create')
            ->middleware('permission_sh:company_types.create');

    Route::put('company_types/{company_type}', 'CompanyTypeController@update')->name('company_types.update')
            ->middleware('permission_sh:company_types.edit');

    Route::get('company_types/{company_type}', 'CompanyTypeController@show')->name('company_types.show')
            ->middleware('permission_sh:company_types.show');

    Route::delete('company_types/{company_type}', 'CompanyTypeController@destroy')->name('company_types.destroy')
             ->middleware('permission_sh:company_types.destroy');

    Route::get('company_types/{company_type}/edit', 'CompanyTypeController@edit')->name('company_types.edit')
            ->middleware('permission_sh:company_types.edit');

                //event_types
    Route::post('event_types/store', 'EventTypesController@store')->name('event_types.store')
            ->middleware('permission_sh:event_types.create');

    Route::get('event_types', 'EventTypesController@index')->name('event_types.index')
            ->middleware('permission_sh:event_types.index');

    Route::get('event_types/create', 'EventTypesController@create')->name('event_types.create')
            ->middleware('permission_sh:event_types.create');

    Route::put('event_types/{event_type}', 'EventTypesController@update')->name('event_types.update')
            ->middleware('permission_sh:event_types.edit');

    Route::get('event_types/{event_type}', 'EventTypesController@show')->name('event_types.show')
            ->middleware('permission_sh:event_types.show');

    Route::delete('event_types/{event_type}', 'EventTypesController@destroy')->name('event_types.destroy')
             ->middleware('permission_sh:event_types.destroy');

    Route::get('event_types/{event_type}/edit', 'EventTypesController@edit')->name('event_types.edit')
            ->middleware('permission_sh:event_types.edit');


                //id_types
    Route::post('id_types/store', 'IdTypeController@store')->name('id_types.store')
            ->middleware('permission_sh:id_types.create');

    Route::get('id_types', 'IdTypeController@index')->name('id_types.index')
            ->middleware('permission_sh:id_types.index');

    Route::get('id_types/create', 'IdTypeController@create')->name('id_types.create')
            ->middleware('permission_sh:id_types.create');

    Route::put('id_types/{id_type}', 'IdTypeController@update')->name('id_types.update')
            ->middleware('permission_sh:id_types.edit');

    Route::get('id_types/{id_type}', 'IdTypeController@show')->name('id_types.show')
            ->middleware('permission_sh:id_types.show');

    Route::delete('id_types/{id_type}', 'IdTypeController@destroy')->name('id_types.destroy')
             ->middleware('permission_sh:id_types.destroy');

    Route::get('id_types/{id_type}/edit', 'IdTypeController@edit')->name('id_types.edit')
            ->middleware('permission_sh:id_types.edit');

 
                //events
    Route::post('events/store', 'EventsController@store')->name('events.store')
            ->middleware('permission_sh:events.create');

    Route::get('events', 'EventsController@index')->name('events.index')
            ->middleware('permission_sh:events.index');

    Route::get('events/create', 'EventsController@create')->name('events.create')
            ->middleware('permission_sh:events.create');
    
            Route::get('events/tipos-eventos/', 'EventsController@getTiposEventos')->name('tipos-eventos.create');

    Route::put('events/{event}', 'EventsController@update')->name('events.update')
            ->middleware('permission_sh:events.edit');

    Route::get('events/{event}', 'EventsController@show')->name('events.show')
            ->middleware('permission_sh:events.show');

    Route::delete('events/{event}', 'EventsController@destroy')->name('events.destroy')
             ->middleware('permission_sh:events.destroy');

    Route::get('events/{event}/edit', 'EventsController@edit')->name('events.edit')
            ->middleware('permission_sh:events.edit');
    
    

    //Divulgación
    Route::get('divulgation', 'DivulgationController@index')->name('divulgation.index')
            ->middleware('permission_sh:divulgation.index');

    Route::get('panel-evento/{event}', 'DivulgationController@eventDetail')->name('panel-evento.show')
            ->middleware('permission_sh:event-detail.show');

   Route::get('revision/{event}', 'DivulgationController@eventDataTable')->name('review-evento.show')
            ->middleware('permission_sh:review-evento.show');
    
  





    //Argumentacion Gremial
    Route::get('guild-argumentation', 'GuildArgumentationController@index')->name('guild-argumentation.index')
            ->middleware('permission_sh:guild-argumentation.index');

    //Fortalecimiento Empresarial
    Route::get('business-str', 'BusinessStrController@index')->name('business-str.index')
            ->middleware('permission_sh:business-str.index');


    //Apoyo Logístico
    Route::get('logistical-support', 'LogisticalSupportController@index')->name('logistical-support.index')
            ->middleware('permission_sh:logistical-support.index');

});
