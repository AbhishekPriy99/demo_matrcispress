<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsiteSettingsController;
use App\Http\Controllers\WordpressPosts;
use App\Http\Controllers\WordpressUsers;
use App\Http\Controllers\WordpressComment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(Route('login'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('groups/datatable', [GroupController::class, 'datatable'])->name('groups.datatable');
    Route::get('websites/content', [WebsiteController::class, 'content'])->name('websites.content');
    Route::get('websites/admin-login/{id}', [WebsiteController::class, 'adminLogin'])->name('websites.admin-login');
    Route::post('websites/check-updates/{id}', [WebsiteController::class, 'checkUpdates'])->name('websites.check-updates');
    Route::post('websites/wp-update/{type}', [WebsiteController::class, 'wpUpdate'])->name('websites.wp-update');
    Route::post('websites/check-ssl/{id}', [WebsiteController::class, 'checkSsl'])->name('websites.check-ssl');
    Route::post('websites/update-ssl-permission/{id}', [WebsiteController::class, 'updateSslPermission'])->name('websites.update-ssl-permission');
    Route::resources([
        'groups' => GroupController::class,
        'websites' => WebsiteController::class,
    ]);    

    Route::get('websites/settings/web-security/{id}', [WebsiteSettingsController::class, 'webSecurity'])->name('websites.settings.websecurity');
    Route::post('websites/check-login-status/{id}', [WebsiteSettingsController::class, 'checkLoginStatus'])->name('websites.check-login-status');
    Route::post('websites/update-login-status/{id}', [WebsiteSettingsController::class, 'updateLoginStatus'])->name('websites.update-login-status');
    Route::post('websites/update-login-url/{id}', [WebsiteSettingsController::class, 'updateLoginUrl'])->name('websites.update-login-url');
    Route::post('websites/update-table-prefix/{id}', [WebsiteSettingsController::class, 'updateTablePrefix'])->name('websites.update-table-prefix');
    Route::post('websites/update-login-username/{id}', [WebsiteSettingsController::class,'updateLoginUsername'])->name('websites.update-login-username');
    Route::get('websites/settings/db-optimization', [WebsiteSettingsController::class, 'dbOptimization'])->name('websites.settings.dboptimization');
    Route::get('websites/settings/seo', [WebsiteSettingsController::class, 'seo'])->name('websites.settings.seo');

     // website notes 
     Route::any('websites-notes/{website}', [WebsiteController::class, 'notes'])->name('websites.notes'); 

    //  Route::get('wordpress/posts/content', [WordpressPosts::class, 'content'])->name('wordpress.posts.content');
    //  Route::get('wordpress-posts/lists/{website}', [WordpressPosts::class, 'lists'])->name('wordpress.posts.lists');
    //  Route::post('wordpress-posts/save', [WordpressPosts::class, 'save'])->name('wordpress.posts.save');
    //  Route::post('wordpress-posts/delete/{post}', [WordpressPosts::class, 'destroy'])->name('wordpress.posts.delete');

    // website posts routescontent
    Route::get('wordpress-posts', [WordpressPosts::class, 'index'])->name('wordpress.posts');
    Route::get('wordpress/posts/content', [WordpressPosts::class, 'content'])->name('wordpress.posts.content');
    Route::get('wordpress-posts/lists/{website}', [WordpressPosts::class, 'lists'])->name('wordpress.posts.lists');
    Route::post('wordpress-posts/save', [WordpressPosts::class, 'save'])->name('wordpress.posts.save');
    Route::post('wordpress-posts/delete/{post}', [WordpressPosts::class, 'destroy'])->name('wordpress.posts.delete');
    
    // Websites comments routes
    Route::get('wordpress-comment', [WordpressComment::class, 'index'])->name('wordpress.comments');
    Route::get('wordpress/comments/content', [WordpressComment::class, 'content'])->name('wordpress.comments.content');
    Route::get('wordpress-comment/lists/{website}', [WordpressComment::class, 'lists'])->name('wordpress.comments.lists');
    Route::get('wordpress-comment/listscontent/{website}', [WordpressComment::class, 'listsContent'])->name('wordpress.comments.listscontent');
    Route::get('wordpress-comment/status/{comment}/{status}/{website}', [WordpressComment::class, 'changeStatus'])->name('wordpress.comments.status');
    Route::get('wordpress-comment/reply/{postid}/{comment_id}/{website}', [WordpressComment::class, 'replyForm'])->name('wordpress.reply.form');
    Route::post('wordpress-comment/save', [WordpressComment::class, 'save'])->name('wordpress.comments.save');
    Route::delete('wordpress-comment/delete/{comment}/{website}', [WordpressComment::class, 'destroy'])->name('wordpress.comments.delete');

    //Websites comments routes
    Route::get('wordpress-user', [WordpressUsers::class, 'index'])->name('wordpress.users');
    Route::get('wordpress-user/content', [WordpressUsers::class, 'content'])->name('wordpress.users.content');
    Route::get('wordpress-user/create/{website}', [WordpressUsers::class, 'create'])->name('wordpress.users.create');
    Route::post('wordpress-user/save/{website}', [WordpressUsers::class, 'save'])->name('wordpress.users.save');
    Route::get('wordpress-user/lists/{website}', [WordpressUsers::class, 'lists'])->name('wordpress.users.lists');
    Route::get('wordpress-user/listscontent/{website}', [WordpressUsers::class, 'listsContent'])->name('wordpress.users.listscontent'); 
    Route::delete('wordpress-user/delete/{user_id}/{website_id}', [WordpressUsers::class, 'destroy'])->name('wordpress.users.delete'); 
    Route::get('wordpress-user/updateModal/{user_id}/{website_id}', [WordpressUsers::class, 'updateModal'])->name('wordpress.users.updateModal');  
    Route::put('wordpress-user/update/{user_id}/{website_id}', [WordpressUsers::class, 'update'])->name('wordpress.users.update');  
});



require __DIR__.'/auth.php';
