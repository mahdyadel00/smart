<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Controllers\AdminController;
use App\Modules\Admin\Controllers\LanguageController;
use App\Modules\Admin\Controllers\DashboardController;
use App\Modules\Admin\Controllers\Jobs\JobsController;
use App\Modules\Admin\Controllers\AdminLoginController;
use App\Modules\Admin\Controllers\Roles\RoleController;
use App\Modules\Admin\Controllers\Pages\PagesController;
use App\Modules\Admin\Controllers\Roles\RolesController;
use App\Modules\Admin\Controllers\Users\UsersController;
use App\Modules\Admin\Controllers\Settings\SliderController;
use App\Modules\Admin\Controllers\Contact\ContactsController;
use App\Modules\Admin\Controllers\Modules\ModulesController;
use App\Modules\Admin\Controllers\Modules\InteroductionModulesController;
use App\Modules\Admin\Controllers\Modules\GoalsModulesController;
use App\Modules\Admin\Controllers\Instructions\InstructionsController;
use App\Modules\Admin\Controllers\Settings\SettingsController;
use App\Modules\Admin\Controllers\Permissions\PermissionsController;
use App\Modules\Admin\Controllers\Questions\QuestiontController;
use App\Modules\Admin\Controllers\Questions\QuestionDetailsController;
use App\Modules\Admin\Controllers\Questions\QuestionSelectController;
use App\Modules\Admin\Controllers\QuizModule\QuizeModuleController;
use App\Modules\Admin\Controllers\ContentModule\ContentModuleController;
use App\Modules\Admin\Controllers\GroupModule\GroupModuleController;
use App\Modules\Admin\Controllers\ActivityModules\ActivityModulesController;
use App\Modules\Admin\Controllers\Login\LoginController;
use App\Modules\Admin\Controllers\Main\MainController;
use App\Modules\Admin\Controllers\Main\MainGoalsController;
use App\Modules\Admin\Controllers\Main\MainInsturcationController;
use App\Modules\Admin\Controllers\Help\HelpController;

Route::prefix('admin')->group(function () {
    Route::get('/lang/{locale?}', [DashboardController::class, 'changeLang']);
    Route::get('login-show', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'doLogin'])->name('admin.do.login');

    Route::group(['middleware' => ['auth:admin']], function () {

        Route::get('profile/{id}', [AdminController::class, 'editProfile'])->name('admin.editProfile');
        Route::post('profilePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::post('profile', [AdminController::class, 'updateprofile'])->name('admin.updateprofile');

        Route::get('all_users', [UsersController::class, 'index'])->name('users.any');
        Route::post('change_user_activity', [UsersController::class, 'update'])->name('users.activity');
        Route::post('change_user_password', [UsersController::class, 'change_pass'])->name('users.password');

        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/', [DashboardController::class, 'index'])->name('admin.home')->middleware(['permission:Dashboard']);
        Route::get('/salesSearch', [DashboardController::class, 'salesSearch'])->name('admin.salesSearch')->middleware(['permission:Dashboard']);
        Route::get('/wordsSearch', [DashboardController::class, 'wordsSearch'])->name('admin.wordsSearch')->middleware(['permission:Dashboard']);
        Route::get('/lastOrders', [DashboardController::class, 'lastOrders'])->name('admin.lastOrders')->middleware(['permission:Dashboard']);

        Route::get('language/getLang', [LanguageController::class, 'getLang'])->name('admin.get.lang');

        //Modules
        Route::get('modules', [ModulesController::class, 'index'])->name('modules.index');
        Route::get('modules/create', [ModulesController::class, 'create'])->name('modules.create');
        Route::post('modules/store', [ModulesController::class, 'store'])->name('modules.store');
        Route::get('modules/{id}/edit', [ModulesController::class, 'edit'])->name('modules.edit');
        Route::post('modules/{id}/update', [ModulesController::class, 'update'])->name('modules.update');
        Route::get('modules/get_translation', [ModulesController::class, 'getTranslation'])->name('modules.get.translation');
        Route::post('modules/store_translation', [ModulesController::class, 'storeTranslation'])->name('modules.store.translation');
        Route::get('modules/{id}', [ModulesController::class, 'delete'])->name('modules.delete');
        // interoduction_modulesModules
        Route::get('interoduction_modules', [InteroductionModulesController::class, 'index'])->name('interoduction_modules.index');
        Route::get('interoduction_modules/create', [InteroductionModulesController::class, 'create'])->name('interoduction_modules.create');
        Route::post('interoduction_modules/store', [InteroductionModulesController::class, 'store'])->name('interoduction_modules.store');
        Route::get('interoduction_modules/{id}/edit', [InteroductionModulesController::class, 'edit'])->name('interoduction_modules.edit');
        Route::post('interoduction_modules/{id}/update', [InteroductionModulesController::class, 'update'])->name('interoduction_modules.update');
        Route::get('interoduction_modules/get_translation', [InteroductionModulesController::class, 'getTranslation'])->name('interoduction_modules.get.translation');
        Route::post('interoduction_modules/store_translation', [InteroductionModulesController::class, 'storeTranslation'])->name('interoduction_modules.store.translation');
        Route::get('interoduction_modules/{id}', [InteroductionModulesController::class, 'delete'])->name('interoduction_modules.delete');

        //Goals Modules
        Route::get('goals_modules', [GoalsModulesController::class, 'index'])->name('goals_modules.index');
        Route::get('goals_modules/create', [GoalsModulesController::class, 'create'])->name('goals_modules.create');
        Route::post('goals_modules/store', [GoalsModulesController::class, 'store'])->name('goals_modules.store');
        Route::get('goals_modules/{id}/edit', [GoalsModulesController::class, 'edit'])->name('goals_modules.edit');
        Route::post('goals_modules/{id}/update', [GoalsModulesController::class, 'update'])->name('goals_modules.update');
        Route::get('goals_modules/get_translation', [GoalsModulesController::class, 'getTranslation'])->name('goals_modules.get.translation');
        Route::post('goals_modules/store_translation', [GoalsModulesController::class, 'storeTranslation'])->name('goals_modules.store.translation');
        Route::get('goals_modules/{id}', [GoalsModulesController::class, 'delete'])->name('goals_modules.delete');
        //Goals Insturctions
        Route::get('insturctions', [InstructionsController::class, 'index'])->name('insturctions.index');
        Route::get('insturctions/create', [InstructionsController::class, 'create'])->name('insturctions.create');
        Route::post('insturctions/store', [InstructionsController::class, 'store'])->name('insturctions.store');
        Route::get('insturctions/{id}/edit', [InstructionsController::class, 'edit'])->name('insturctions.edit');
        Route::post('insturctions/{id}/update', [InstructionsController::class, 'update'])->name('insturctions.update');
        Route::get('insturctions/get_translation', [InstructionsController::class, 'getTranslation'])->name('insturctions.get.translation');
        Route::post('insturctions/store_translation', [InstructionsController::class, 'storeTranslation'])->name('insturctions.store.translation');
        Route::get('insturctions/{id}', [InstructionsController::class, 'delete'])->name('insturctions.delete');
        //Content Module
        Route::get('content_modules', [ContentModuleController::class, 'index'])->name('content_modules.index');
        Route::get('content_modules/create', [ContentModuleController::class, 'create'])->name('content_modules.create');
        Route::post('content_modules/store', [ContentModuleController::class, 'store'])->name('content_modules.store');
        Route::get('content_modules/{id}/edit', [ContentModuleController::class, 'edit'])->name('content_modules.edit');
        Route::post('content_modules/{id}/update', [ContentModuleController::class, 'update'])->name('content_modules.update');
        Route::get('content_modules/get_translation', [ContentModuleController::class, 'getTranslation'])->name('content_modules.get.translation');
        Route::post('content_modules/store_translation', [ContentModuleController::class, 'storeTranslation'])->name('content_modules.store.translation');
        Route::get('content_modules/{id}', [ContentModuleController::class, 'delete'])->name('content_modules.delete');

        //Group Module
        Route::get('group_module', [GroupModuleController::class, 'index'])->name('group_module.index');
        Route::get('group_module/create', [GroupModuleController::class, 'create'])->name('group_module.create');
        Route::post('group_module/store', [GroupModuleController::class, 'store'])->name('group_module.store');
        Route::get('group_module/{id}/edit', [GroupModuleController::class, 'edit'])->name('group_module.edit');
        Route::post('group_module/{id}/update', [GroupModuleController::class, 'update'])->name('group_module.update');
        Route::get('group_module/get_translation', [GroupModuleController::class, 'getTranslation'])->name('group_module.get.translation');
        Route::post('group_module/store_translation', [GroupModuleController::class, 'storeTranslation'])->name('group_module.store.translation');
        Route::get('group_module/{id}', [GroupModuleController::class, 'delete'])->name('group_module.delete');

        //Goals activity_modules
        Route::get('activity_modules', [ActivityModulesController::class, 'index'])->name('activity_modules.index');
        Route::get('activity_modules/create', [ActivityModulesController::class, 'create'])->name('activity_modules.create');
        Route::post('activity_modules/store', [ActivityModulesController::class, 'store'])->name('activity_modules.store');
        Route::get('activity_modules/{id}/edit', [ActivityModulesController::class, 'edit'])->name('activity_modules.edit');
        Route::get('activity_modules/{id}/show', [ActivityModulesController::class, 'show'])->name('activity_modules.show');
        Route::post('activity_modules/{id}/update', [ActivityModulesController::class, 'update'])->name('activity_modules.update');
        Route::get('activity_modules/get_translation', [ActivityModulesController::class, 'getTranslation'])->name('activity_modules.get.translation');
        Route::post('activity_modules/store_translation', [ActivityModulesController::class, 'storeTranslation'])->name('activity_modules.store.translation');
        Route::get('activity_modules/{id}', [ActivityModulesController::class, 'delete'])->name('activity_modules.delete');

        //sliders
        Route::get('settings/sliders', [SliderController::class, 'index'])->name('slider.index');
        Route::post('settings/sliders/store', [SliderController::class, 'store']);
        Route::post('settings/sliders/update', [SliderController::class, 'update']);
        Route::get('settings/sliders/get/lang/value', [SliderController::class, 'getLangValue']);
        Route::post('settings/sliders/lang/store', [SliderController::class, 'storelangTranslation']);
        Route::delete('settings/sliders/{id}', [SliderController::class, 'delete'])->name('admin_slider.destroy');


        //Questions
        Route::get('questions', [QuestiontController::class, 'index'])->name('questions.index');
        Route::get('questions/create', [QuestiontController::class, 'create'])->name('questions.create');
        Route::post('questions/store', [QuestiontController::class, 'store'])->name('questions.store');
        Route::get('questions/{questions}/edit', [QuestiontController::class, 'edit'])->name('questions.edit');
        Route::post('questions/{id}/update', [QuestiontController::class, 'update'])->name('questions.update');
        Route::get('questions/get_translation', [QuestiontController::class, 'getTranslation'])->name('questions.get.translation');
        Route::post('questions/store_translation', [QuestiontController::class, 'storeTranslation'])->name('questions.store.translation');
        Route::get('questions/{delete}', [QuestiontController::class, 'delete'])->name('questions.delete');

        //Question Details

        Route::get('question_details' , [QuestionDetailsController::class , 'index'])->name('question_details.index');
        Route::get('question_details/create' , [QuestionDetailsController::class , 'create'])->name('question_details.create');
        Route::post('question_details/store' , [QuestionDetailsController::class , 'store'])->name('question_details.store');
        Route::get('question_details/{question_details}/edit' , [QuestionDetailsController::class , 'edit'])->name('question_details.edit');
        Route::post('question_details/{id}/update' , [QuestionDetailsController::class , 'update'])->name('question_details.update');
        Route::get('question_details/{delete}' , [QuestionDetailsController::class , 'delete'])->name('question_details.delete');

        //Question Select

        Route::get('question_select' , [QuestionSelectController::class , 'index'])->name('question_select.index');
        Route::get('question_select/create' , [QuestionSelectController::class , 'create'])->name('question_select.create');
        Route::post('question_select/store' , [QuestionSelectController::class , 'store'])->name('question_select.store');
        Route::get('question_select/{question_select}/edit' , [QuestionSelectController::class , 'edit'])->name('question_select.edit');
        Route::post('question_select/{id}/update' , [QuestionSelectController::class , 'update'])->name('question_select.update');
        Route::get('question_select/{delete}' , [QuestionSelectController::class , 'delete'])->name('question_select.delete');

        //Quiz After module
        Route::get('quiz_module', [QuizeModuleController::class, 'index'])->name('quiz_module.index');
        Route::get('quiz_module/create', [QuizeModuleController::class, 'create'])->name('quiz_module.create');
        Route::post('quiz_module/store', [QuizeModuleController::class, 'store'])->name('quiz_module.store');
        Route::get('quiz_module/{quiz_module}/edit', [QuizeModuleController::class, 'edit'])->name('quiz_module.edit');
        Route::post('quiz_module/{id}/update', [QuizeModuleController::class, 'update'])->name('quiz_module.update');
        Route::get('quiz_module/get_translation', [QuizeModuleController::class, 'getTranslation'])->name('quiz_module.get.translation');
        Route::post('quiz_module/store_translation', [QuizeModuleController::class, 'storeTranslation'])->name('quiz_module.store.translation');
        Route::get('quiz_module/{delete}', [QuizeModuleController::class, 'delete'])->name('quiz_module.delete');

        //Login
        Route::get('login', [LoginController::class, 'index'])->name('login.index');
        Route::get('login/create', [LoginController::class, 'create'])->name('login.create');
        Route::post('login/store', [LoginController::class, 'store'])->name('login.store');
        Route::get('login/{login}/edit', [LoginController::class, 'edit'])->name('login.edit');
        Route::post('login/update', [LoginController::class, 'update'])->name('login.update');
        Route::get('login/get_translation', [LoginController::class, 'getTranslation'])->name('login.get.translation');
        Route::post('login/store_translation', [LoginController::class, 'storeTranslation'])->name('login.store.translation');
        Route::get('login/{delete}', [LoginController::class, 'delete'])->name('login.delete');
        //Main Page
        Route::get('main_page', [MainController::class, 'index'])->name('main_page.index');
        Route::get('main_page/create', [MainController::class, 'create'])->name('main_page.create');
        Route::post('main_page/store', [MainController::class, 'store'])->name('main_page.store');
        Route::get('main_page/{main}/edit', [MainController::class, 'edit'])->name('main_page.edit');
        Route::post('main_page/update', [MainController::class, 'update'])->name('main_page.update');
        Route::get('main_page/get_translation', [MainController::class, 'getTranslation'])->name('main_page.get.translation');
        Route::post('main_page/store_translation', [MainController::class, 'storeTranslation'])->name('main_page.store.translation');
        Route::get('main_page/{delete}', [MainController::class, 'delete'])->name('main_page.delete');

        //Main Goals
        Route::get('main_goals', [MainGoalsController::class, 'index'])->name('main_goals.index');
        Route::get('main_goals/create', [MainGoalsController::class, 'create'])->name('main_goals.create');
        Route::post('main_goals/store', [MainGoalsController::class, 'store'])->name('main_goals.store');
        Route::get('main_goals/{main}/edit', [MainGoalsController::class, 'edit'])->name('main_goals.edit');
        Route::post('main_goals/update', [MainGoalsController::class, 'update'])->name('main_goals.update');
        Route::get('main_goals/get_translation', [MainGoalsController::class, 'getTranslation'])->name('main_goals.get.translation');
        Route::post('main_goals/store_translation', [MainGoalsController::class, 'storeTranslation'])->name('main_goals.store.translation');
        Route::get('main_goals/{delete}', [MainGoalsController::class, 'delete'])->name('main_goals.delete');

        //Main Insturcation
        Route::get('main_insturcation', [MainInsturcationController::class, 'index'])->name('main_insturcation.index');
        Route::get('main_insturcation/create', [MainInsturcationController::class, 'create'])->name('main_insturcation.create');
        Route::post('main_insturcation/store', [MainInsturcationController::class, 'store'])->name('main_insturcation.store');
        Route::get('main_insturcation/{main}/edit', [MainInsturcationController::class, 'edit'])->name('main_insturcation.edit');
        Route::post('main_insturcation/update', [MainInsturcationController::class, 'update'])->name('main_insturcation.update');
        Route::get('main_insturcation/get_translation', [MainInsturcationController::class, 'getTranslation'])->name('main_insturcation.get.translation');
        Route::post('main_insturcation/store_translation', [MainInsturcationController::class, 'storeTranslation'])->name('main_insturcation.store.translation');
        Route::get('main_insturcation/{delete}', [MainInsturcationController::class, 'delete'])->name('main_insturcation.delete');

        //Help
        Route::get('help', [HelpController::class, 'index'])->name('help.index');
        Route::get('help/create', [HelpController::class, 'create'])->name('help.create');
        Route::post('help/store', [HelpController::class, 'store'])->name('help.store');
        Route::get('help/{main}/edit', [HelpController::class, 'edit'])->name('help.edit');
        Route::post('help/{id}/update', [HelpController::class, 'update'])->name('help.update');
        Route::get('help/get_translation', [HelpController::class, 'getTranslation'])->name('help.get.translation');
        Route::post('help/store_translation', [HelpController::class, 'storeTranslation'])->name('help.store.translation');
        Route::get('help/{delete}', [HelpController::class, 'delete'])->name('help.delete');

        //Pages
        Route::get('pages', [PagesController::class, 'index'])->name('pages.index')->middleware(['permission:Pages']);
        Route::get('pages/create', [PagesController::class, 'create'])->name('pages.create')->middleware(['permission:Pages']);
        Route::post('pages/store', [PagesController::class, 'store'])->name('pages.store')->middleware(['permission:Pages']);
        Route::get('pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
        Route::post('pages/update/{id}', [PagesController::class, 'update'])->name('pages.update')->middleware(['permission:Pages']);
        Route::delete('pages/{id}', [PagesController::class, 'delete'])->name('pages.destroy')->middleware(['permission:Pages']);
        Route::get('pages/get/lang/value', [PagesController::class, 'pagergetLangvalue'])->name('page_lang_value')->middleware(['permission:Pages']);
        Route::post('pages/lang/store', [PagesController::class, 'pagestorelangTranslation'])->name('page_lang_store')->middleware(['permission:Pages']);

        //Contants
        Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{id}', [ContactsController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/update/{id}', [ContactsController::class, 'update'])->name('contacts.update');
        Route::get('contacts/{id}/delete', [ContactsController::class, 'delete'])->name('contacts.delete');
        Route::post('contact/{id}/reply', [ContactsController::class, 'reply'])->name('admin.contact.reply');
        //Settings
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index')->middleware(['permission:Settings']);
        Route::get('settings/get', [SettingsController::class, 'get_settings'])->name('settings.edit')->middleware(['permission:Settings']);
        Route::patch('settings/get', [SettingsController::class, 'updateSettings'])->name('settings.update')->middleware(['permission:Settings']);
        Route::get('settings/translation', [SettingsController::class, 'getSettingsTranslation'])->name('settings.translation')->middleware(['permission:Settings']);
        Route::patch('settings/translation', [SettingsController::class, 'updateSettingsTranslation'])->name('settings.update_translation')->middleware(['permission:Settings']);
        Route::post('settings/save_domain', [SettingsController::class, 'saveDomain'])->name('settings.saveDomain')->middleware(['permission:Settings']);
        Route::get('settings/check', [SettingsController::class, 'check'])->middleware(['permission:Settings']);


       //Permissions
        Route::get('permissions', [PermissionsController::class, 'index'])->name('site.admin.permissions');
        Route::post('permissions', [PermissionsController::class, 'store'])->name('site.admin.permissions.store');
        Route::patch('permissions/update', [PermissionsController::class, 'update'])->name('site.admin.permissions.update');
        Route::post('permissions/store_translation', [PermissionsController::class, 'storeTranslation'])->name('site.admin.permissions.storeTranslation');
        Route::get('permissions/getLangValue', [PermissionsController::class, 'getLangValue'])->name('site.admin.permissions.getLangValue');
        Route::delete('permissions/{id}/delete', [PermissionsController::class, 'delete'])->name('site.admin.permissions.delete');

        //Roles
        Route::get('roles', [RolesController::class, 'index'])->name('site.admin.roles');
        Route::get('roles/create', [RolesController::class, 'create'])->name('site.admin.roles.create');
        Route::get('roles/{id}', [RolesController::class, 'edit'])->name('site.admin.roles.edit');
        Route::post('roles', [RolesController::class, 'store'])->name('site.admin.roles.store');
        Route::post('roles/{id}', [RolesController::class, 'update'])->name('site.admin.roles.update');
        Route::delete('roles/{id}/delete', [RolesController::class, 'destroy'])->name('site.admin.roles.destroy');
        Route::get('roles/get_permissions/{lang}', [RolesController::class, 'getPermissions']);

        Route::get('role/dataTable', [RoleController::class, 'dataTable']);
        Route::get('role/export', [RoleController::class, 'export'])->name('role.export');

        //Admin
        Route::get('admin', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'index'])->name('admin.index');
        Route::get('admin/export', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'export'])->name('admin.export');
        Route::get('admin/create', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'create'])->name('admin.create');
        Route::get('admin/{user}/edit', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'edit'])->name('admin.edit');
        Route::post('admin', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'store'])->name('admin.store');
        Route::patch('admin/{user}', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'update'])->name('admin.update');
        Route::patch('admin/{user}/change_password', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'changePassword'])->name('admin.change_password');
        Route::get('admin/{id}', [\App\Modules\Admin\Controllers\Roles\AdminController::class, 'destroy'])->name('admin.destroy');

        Route::get('role/get_permissions/{lang}', [RoleController::class, 'getPermissions']);
        Route::resource('role', RoleController::class);

    });
});
