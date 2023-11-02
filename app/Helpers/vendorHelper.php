<?php 

function _prx($data){
    echo '<pre>'.print_r($data, true).'</pre>';
}

function pre($data){
    echo '<pre>'.print_r($data, true).'</pre>';
}

if( !function_exists('generateSecureHash') ){
    function generateSecureHash($id, $key = '!7l@S*3h7_s54P-e543lp')
    {
        $len = 10;
        $md5_key = md5($key);
        $len_jobid = 16;
        $sub_md5key1 = substr($md5_key, 0, $len);
        $sub_md5key2 = substr($md5_key, $len);
        return $sub_md5key1 . $id . $sub_md5key2;
    }

}

if( !function_exists('decodeSecureHash') ){
    function decodeSecureHash($encodeid, $vauletype = 'integer')
    {
        $strRet = "";
        $len = 10;
        $sub_md5key1 = substr($encodeid, 0, $len);
        $sub_md5key2 = substr($encodeid, -1 * (32 - $len));
        $strRet = str_replace(array($sub_md5key1, $sub_md5key2), '', $encodeid);
        if ($vauletype == 'integer')
            $strRet = (int) $strRet;
        else
            $strRet = $strRet;

        return $strRet;
    }
}

if( !function_exists('sanitize_filename') ){
    function sanitize_filename($filename)
    {
        // Remove special accented characters - ie. sí.
        $clean_name = strtr($filename, array('Š' => 'S', 'Ž' => 'Z', 'š' => 's', 'ž' => 'z', 'Ÿ' => 'Y', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y'));
        $clean_name = strtr($clean_name, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));
    
        $clean_name = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $clean_name);
        $clean_name = strtolower($clean_name);
    
        return $clean_name;
    }
}

if( !function_exists('decimalprice') ){
    function decimalprice($price, $decimal_price = false)
    {
    
        if ($decimal_price) {
            return $price;
        }
        return round($price);
    }
}

if( !function_exists('pricecalculate') ){
    function pricecalculate($drivervalue, $percentdiff, $decimal_price = false)
    {
        $drivervalue *= (1 + $percentdiff / 100);
        if ($decimal_price) {
            return $drivervalue;
        }
        return round($drivervalue);
    }
}

if( !function_exists('getRatio') ){
    function getRatio($num1, $num2)
    {
        for ($i = $num2; $i > 1; $i--) {
            if (($num1 % $i) == 0 && ($num2 % $i) == 0) {
                $num1 = $num1 / $i;
                $num2 = $num2 / $i;
            }
        }
        return "$num1:$num2";
    }
}

function get_bank_detail($type, $snapshot = null)
{
    if ($snapshot == null) {

        if (!isset(Auth::user()->bank_details['show'][$type])) {
            return false;
        }
        if (Auth::user()->bank_details['show'][$type]) {
            return Auth::user()->bank_details[$type];
        } else {
            return false;
        }
    } else {

        if (!isset($snapshot['bank_details']['show'][$type])) {
            return false;
        }
        if ($snapshot['bank_details']['show'][$type]) {
            return $snapshot['bank_details'][$type];
        } else {
            return false;
        }
    }
}

function getDescriptionWidth($snapshot)
{
    if ($snapshot['show_quantity_and_rate'] && $snapshot['show_sac_code'] && $snapshot['show_tax']) {
        $description_width = 200;
    } else if ($snapshot['show_sac_code'] && $snapshot['show_tax']) {
        $description_width = 200;
    } else if ($snapshot['show_quantity_and_rate'] && $snapshot['show_tax']) {
        $description_width = 300;
    } else {
        $description_width = 400;
    }

    return $description_width;
}

function formatNumberForInvoice($number, $decimal_places = 2)
{
    return number_format((float) $number, $decimal_places, '.', ',');
}

function numsize($size, $round = 2)
{
    $unit = ['', 'K', 'M', 'G', 'T'];
    return round($size / pow(1000, ($i = floor(log($size, 1000)))), $round) . $unit[$i];
}

function calculateCAGR($startValue, $endValue, $numYear)
{
    $cagr = pow(($endValue / $startValue), 1 / $numYear) - 1;
    return round(($cagr * 100), 2);
}


if (!function_exists('theme')) {
    function theme()
    {
        return app(App\Core\Theme::class);
    }
}

if (!function_exists('addHtmlAttribute')) {
    /**
     * Add HTML attributes by scope
     *
     * @param $scope
     * @param $name
     * @param $value
     *
     * @return void
     */
    function addHtmlAttribute($scope, $name, $value)
    {
        theme()->addHtmlAttribute($scope, $name, $value);
    }
}


if (!function_exists('addHtmlAttributes')) {
    /**
     * Add multiple HTML attributes by scope
     *
     * @param $scope
     * @param $attributes
     *
     * @return void
     */
    function addHtmlAttributes($scope, $attributes)
    {
        theme()->addHtmlAttributes($scope, $attributes);
    }
}


if (!function_exists('addHtmlClass')) {
    /**
     * Add HTML class by scope
     *
     * @param $scope
     * @param $value
     *
     * @return void
     */
    function addHtmlClass($scope, $value)
    {
        theme()->addHtmlClass($scope, $value);
    }
}


if (!function_exists('printHtmlAttributes')) {
    /**
     * Print HTML attributes for the HTML template
     *
     * @param $scope
     *
     * @return string
     */
    function printHtmlAttributes($scope)
    {
        return theme()->printHtmlAttributes($scope);
    }
}


if (!function_exists('printHtmlClasses')) {
    /**
     * Print HTML classes for the HTML template
     *
     * @param $scope
     * @param $full
     *
     * @return string
     */
    function printHtmlClasses($scope, $full = true)
    {
        return theme()->printHtmlClasses($scope, $full);
    }
}

if (!function_exists('getGlobalAssets')) {
    /**
     * Get the global assets
     *
     * @param $type
     *
     * @return array
     */
    function getGlobalAssets($type = 'js')
    {
        return theme()->getGlobalAssets($type);
    }
}


if (!function_exists('addVendors')) {
    /**
     * Add multiple vendors to the page by name. Refer to settings THEME_VENDORS
     *
     * @param $vendors
     *
     * @return void
     */
    function addVendors($vendors)
    {
        theme()->addVendors($vendors);
    }
}


if (!function_exists('includeFavicon')) {
    /**
     * Include favicon from settings
     *
     * @return string
     */
    function includeFavicon()
    {
        return theme()->includeFavicon();
    }
}

if (!function_exists('addVendor')) {
    /**
     * Add single vendor to the page by name. Refer to settings THEME_VENDORS
     *
     * @param $vendor
     *
     * @return void
     */
    function addVendor($vendor)
    {
        theme()->addVendor($vendor);
    }
}


if (!function_exists('addJavascriptFile')) {
    /**
     * Add custom javascript file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addJavascriptFile($file)
    {
        theme()->addJavascriptFile($file);
    }
}


if (!function_exists('addCssFile')) {
    /**
     * Add custom CSS file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addCssFile($file)
    {
        theme()->addCssFile($file);
    }
}


if (!function_exists('getVendors')) {
    /**
     * Get vendor files from settings. Refer to settings THEME_VENDORS
     *
     * @param $type
     *
     * @return array
     */
    function getVendors($type)
    {
        return theme()->getVendors($type);
    }
}


if (!function_exists('getCustomJs')) {
    /**
     * Get custom js files from the settings
     *
     * @return array
     */
    function getCustomJs()
    {
        return theme()->getCustomJs();
    }
}


if (!function_exists('getCustomCss')) {
    /**
     * Get custom css files from the settings
     *
     * @return array
     */
    function getCustomCss()
    {
        return theme()->getCustomCss();
    }
}


if (!function_exists('getHtmlAttribute')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $scope
     * @param $attribute
     *
     * @return array
     */
    function getHtmlAttribute($scope, $attribute)
    {
        return theme()->getHtmlAttribute($scope, $attribute);
    }
}

if (!function_exists('isUrl')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $url
     *
     * @return mixed
     */
    function isUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

if (!function_exists('image')) {
    /**
     * Get image url by path
     *
     * @param $path
     *
     * @return string
     */
    function image($path)
    {
        return asset('admin/assets/images/' . $path);
    }
}

function globalDashboardAssets()
{
    return addVendors(['global-dashboard-assets']);
}

function authAssets()
{
    return addVendors(['auth']);
}

if( !function_exists('storage_asset') ){
    function storage_asset($link)
    {
       return asset('storage'.$link);
    }
}

if(!function_exists('random_strings')) {
    function random_strings($length_of_string)
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Shuffle the $str_result and resturn substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }
}

if( !function_exists('public_storage_path') ){
    function public_storage_path($link)
    {
       return public_path('storage'.$link);
    }
}


if (!function_exists('clean')) {
    function clean($dirty, $config = null)
    {
        return app('purifier')->clean($dirty, $config);
    }
}

function sendNotification($device_tokens, $message, $totalunreadcounter, $notification_type = null, $type_id = null)
{
    $SERVER_API_KEY = 'AAAAPnFHeyM:APA91bH2q30UyMV0IvcqkLravcCFYXo7meGwqVd6XnFVgdGVfdfLDv-yyJ9l9VXpWRGjmnZh4XtUjsry8aCyf-A4MBhyGkZgvWAD4hkTqW0220yyX2qMtjXKsU4WVggbL5trYl7TmATK';

    // payload data, it will vary according to requirement
    $device_tokens = array_values(array_unique($device_tokens));
    $data = [
        "registration_ids" => $device_tokens, // for multiple device ids
        "notification" => [
            "title" => 'UnlistedZone',
            "body" => $message,
            "sound" => 'default',
            "data" => [
                'message' => $message,
                'totalunreadcounter' => $totalunreadcounter,
                'notification_type' => $notification_type ?? null,
                'type_id' => $type_id ?? null,
            ],
        ],
        "data" => [
            'message' => $message,
            'totalunreadcounter' => $totalunreadcounter,
            'notification_type' => $notification_type ?? null,
            'type_id' => $type_id ?? null,
        ]
    ];
    $dataString = json_encode($data);

    $headers = [
        'Authorization: key=' . $SERVER_API_KEY,
        'Content-Type: application/json',
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyz'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function percentag_calculation($price, $current_price)
{
    return round((($current_price -  $price) / $price) * 100, 2) . '%';
}

function random_number($length_of_string)
{
    $str_result = '0123456789';
    return substr(
        str_shuffle($str_result),
        0,
        $length_of_string
    );
}

function create_url_from_title($title) {
    // Convert the title to lowercase
    $title = strtolower($title);
    // Replace spaces with hyphens
    $title = str_replace(' ', '-', $title);
    // Remove any characters that are not letters, numbers, hyphens, or underscores
    $title = preg_replace('/[^a-zA-Z0-9-_]/', '', $title);
    // Remove multiple hyphens or underscores in a row
    $title = preg_replace('/[-_]{2,}/', '-', $title);
    // Trim any leading or trailing hyphens or underscores
    $title = trim($title, '-_');
    return $title;
}


function isImage($path)
{
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    return in_array($extension, $imageExtensions);
}

function formatAmount($amount) {
    if ($amount >= 10000000) {
        // Convert to Crores (1 Crore = 10,000,000)
        return round(($amount / 10000000), 2) . ' Cr.';
    } elseif ($amount >= 100000) {
        // Convert to Lakhs (1 Lakh = 100,000)
        return round(($amount / 100000), 2) . ' L';
    } elseif ($amount >= 1000) {
        // Convert to Thousands (1 Thousand = 1,000)
        return round(($amount / 1000), 2) . ' K';
    } else {
        return round($amount, 2);
    }
}