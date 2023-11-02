<?php
namespace App\Library;

use Illuminate\Support\Facades\Http;

class MaticpressClientLib
{
    public $api_app_url;
    public $api_key;
    public $token;
    public $website;
    public $api_fields = array(
        'ACTION' => '',
        'TYPE' => '',
        'ID' => '',
        'AUTHDATA' => array(),
        'KEY' => '',
        'TOKEN' => '',
        'UNIQUE_ID' => '',
        'APPCODE' => '',
        'REQUEST_URL' => '',
        'REGISTER_URL' => '');

    public function __construct($website)
    {
        $this->website = $website;
        $this->api_app_url = $website->url;
        $this->api_key = $website->key;
        $this->token = $website->token;
        $this->api_fields['KEY'] = $website->key;
        $this->api_fields['TOKEN'] = $website->token;
        $this->api_fields['REQUEST_URL'] = $website->url;
    }

    // Start::authentication

    public function appCode($request_data)
    {
        foreach ($this->api_fields as $key => $value) {
            if ($key == "APPCODE") {
                continue;
            }$ipn_fields[] = $key;
        }
        sort($ipn_fields);
        $pop = '';

        foreach ($ipn_fields as $field) {
            $pop = $pop . (!empty($request_data[$field]) ? $request_data[$field] : '') . "|";
        }
        $pop = $pop . $request_data['KEY'];

        $calced_verify = sha1($pop);
        return $calced_verify = strtoupper(substr($calced_verify, 0, 8));
    }

    function verifyToken()
    {
        if (!empty($this->website->token)) {
            $this->api_fields['ACTION'] = 'auth';
            $this->api_fields['TYPE'] = 'tokenization';
            $response = $this->httpRequest();
            if (!empty($response->SUCCESS) && $response->SUCCESS==true) {
                return $this->website->token;
            }
            return $this->generateToken();
        } else {
            return $this->generateToken();
        }
    }

    public function generateToken()
    {
        $this->api_fields['ACTION'] = 'auth';
        $this->api_fields['TYPE'] = 'auth';
        $this->api_fields['TOKEN'] = '';
        $response = $this->httpRequest();
        if (!empty(($response->TOKEN))) {
            $this->setToken($response->TOKEN);
            return $response->TOKEN;
        }
        return false;
    }

    public function setToken($token)
    {
        $this->token = $token;
        $this->api_fields['TOKEN'] = $token;
        $this->website->token = $token;
        $this->website->save();
        // echo "test";
        // session(['api_token' => $token]);
    }
    // End::authentication

    // Start::posts
    function getPosts()
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-posts';
        return $this->httpRequest();
    }

    function getPostsCount()
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-post-count';
        return $this->httpRequest();
    }

    function getPostDetails($post_id)
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-get-post-details';
        $this->api_fields['ID'] = $post_id;
        return $this->httpRequest();
    }

    function getTagAndCategories()
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-tag-and-categories';
        return $this->httpRequest();
    }

    // Create post example:
    // $post_data['title'] = 'This is a test post created from maticpress. ' . time();
    // $post_data['post-content'] = 'This is a test post created from maticpress.';
    // $post_data['post_categories'] = 1;
    function createPost($post_data = array())
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-create-post';
        $this->api_fields['AUTHDATA'] = serialize(['post' => $post_data]);
        return $this->httpRequest();
    }

    // Edit post example:
    // $post_data['title'] = 'This is a test post created from maticpress. ' . time();
    // $post_data['content_new'] = 'This is a test post created from maticpress.';
    // $post_data['post_categories'] = 1;
    function editPost($post_id, $post_data = array())
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'wordpress-edit-post';
        $this->api_fields['ID'] = $post_id;
        $this->api_fields['AUTHDATA'] = serialize(['post' => $post_data]);
        return $this->httpRequest();
    }

    function deletePost($id, $post_data = array())
    {
        $this->api_fields['ACTION'] = 'posts';
        $this->api_fields['TYPE'] = 'delete-wp-post';
        $this->api_fields['ID'] = $id;
        return $this->httpRequest();
    }

    // End::posts

    // Start::domain
    function checkUpdate()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'wordpress-update';
        return $this->httpRequest();
    }

    function fullUpdate()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'domain-update';
        return $this->httpRequest();
    }

    function coreUpdate()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'core-update';
        return $this->httpRequest();
    }

    function pluginUpdate()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'plugin-update';
        return $this->httpRequest();
    }

    function themeUpdate()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'theme-update';
        return $this->httpRequest();
    }

    function directLoggedIn()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'direct-loggedin';
        return $this->httpRequest();
    }

    function checkHideLogin()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'check-hide-login';
        return $this->httpRequest();
    }

    function hideLogin($wp_login_url)
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'hide-login';
        $this->api_fields['AUTHDATA'] = $wp_login_url;
        return $this->httpRequest();
    }

    function getLimitLoginOptions()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'get-limit-login-options';
        return $this->httpRequest();
    }

    function hideLoginStatus($status)
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'hide-login-status';
        $this->api_fields['AUTHDATA'] = $status; //1 for activate hide login, 2 for deactivate hide login
        return $this->httpRequest();
    }

    function loginLimitStatus()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'login-limit-status';
        return $this->httpRequest();
    }

    function limitLoginOptionsSave()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'limit-login-options-save';
        return $this->httpRequest();
    }

    function limitLoginUnlock()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'limit-login-unlock';
        return $this->httpRequest();
    }

    function adminLoginExist()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'admin-login-exist';
        return $this->httpRequest();
    }

    function changeLoginName($new_login_username)
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'change-login-name';
        $this->api_fields['AUTHDATA'] = $new_login_username;

        return $this->httpRequest();
    }

    function changeDatabasePrefix($data)
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'change-database-prefix';
        $this->api_fields['AUTHDATA'] = http_build_query($data);
        return $this->httpRequest();
    }

    function generateRobotsEile()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'generate-robots-file';
        return $this->httpRequest();
    }

    function checkRobotsFile()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'check-robots-file';
        return $this->httpRequest();
    }

    function updateBrokerLinks()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'update-broker-links';
        return $this->httpRequest();
    }

    function getBrokerLinks()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'get-broker-links';
        return $this->httpRequest();
    }

    function editBrokerLinks()
    {
        $this->api_fields['ACTION'] = 'domain';
        $this->api_fields['TYPE'] = 'edit-broker-links';
        return $this->httpRequest();
    }
    // End::domain

    // Start::ssl_permission
    function sslPermission()
    {
        $this->api_fields['ACTION'] = 'ssl_permission';
        $this->api_fields['TYPE'] = 'ssl_permission';
        return $this->httpRequest();
    }

    function getSslPermission()
    {
        $this->api_fields['ACTION'] = 'ssl_permission';
        $this->api_fields['TYPE'] = 'get_ssl_permission';
        return $this->httpRequest();
    }
    // End::ssl_permission

    // Start:: Comments
    function getComments(){
        $this->api_fields['ACTION'] = 'comments';
        $this->api_fields['TYPE'] = 'wordpress-comments';
        return $this->httpRequest();
    }

    function statusComments($post_data){
        $this->api_fields['ACTION'] = 'comments';
        $this->api_fields['TYPE']   = 'comment-status-edit';
        $this->api_fields['AUTHDATA'] = serialize($post_data);
        return $this->httpRequest();
    }

    function replyComments($post_data){
        $this->api_fields['ACTION'] = 'comments';
        $this->api_fields['TYPE']   = 'comment-reply';
        $this->api_fields['AUTHDATA'] = serialize($post_data);
        return $this->httpRequest();
    }

    function deleteComments($comment_id){
        $this->api_fields['ACTION'] = 'comments';
        $this->api_fields['TYPE']   = 'delete-wp-comments';
        $this->api_fields['ID']     = $comment_id;
        return $this->httpRequest($comment_id);
    }
    // End:: Comments

    // Start:: Users
    function getUsers(){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'user-lists';
        return $this->httpRequest();
    }
    function getUsersCount(){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'user-count';
        return $this->httpRequest();
    }
    function getUserDetails($wp_user_id){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'user-details-by-id';
        $this->api_fields['ID']   = $wp_user_id;
        return $this->httpRequest();
    }
    function getWpRoles(){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'wp-roles';
        return $this->httpRequest();
    }
    // create user post_data example:

    // $post_data['first_name']  = '';
    // $post_data['last_name']  = '';
    // $post_data['user_name']  = '';
    // $post_data['user_email']  = '';
    // $post_data['users_password']  = '';
    // $post_data['user_status']  = '';
    // $post_data['user_role']  = '';
    function createUser($post_data){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'create-wp-user';
        $this->api_fields['AUTHDATA']   = http_build_query($post_data);
        return $this->httpRequest();
    }
    // create user post_data example:
    // $post_data['first_name']  = '';
    // $post_data['last_name']  = '';
    // $post_data['password']  = '';
    // $post_data['password_confirm']  = '';
    // $post_data['user_role']  = '';
    // $post_data['company']  = '';  
    function updateUser($post_data,$wp_user_id){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'update-wp-user';
        $this->api_fields['ID']   = $wp_user_id;
        $this->api_fields['AUTHDATA']   = http_build_query($post_data);
        return $this->httpRequest();
    }
    function deleteUser($wp_user_id){
        $this->api_fields['ACTION'] = 'users';
        $this->api_fields['TYPE']   = 'delete-wp-user';
        $this->api_fields['ID']   = $wp_user_id;
        return $this->httpRequest();
    }
    // End:: Users

    private function httpRequest()
    {
        $this->api_fields['APPCODE'] = $this->appCode($this->api_fields);
        $response = Http::get($this->api_fields['REQUEST_URL'], $this->api_fields);
        // pre($response->body());
        if ($response->status() == 200) {
            $response_body = json_decode($response->body());
            // if (!empty($response_body->SUCCESS)) {
            //     pre($response->body());
                return $response_body;
            // }
        }
        return false;
    }

}
