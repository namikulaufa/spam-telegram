<?php
function sendPhoto($chat_id, $path_photo, $jumlah_requests, $hijau, $merah, $reset) {

    // ganti bot token
    $bot_token = '6527414210:AAHnGyN8QDYy5edH7i_GC3-foSp1uh4LXvU';
    $url = "https://api.telegram.org/bot{$bot_token}/sendPhoto";

    for ($i = 0; $i < $jumlah_requests; $i++) {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'chat_id' => $chat_id,
            'photo' => new CURLFile($path_photo)
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $regex = '/"ok":([^,]+).*"username":"([^"]+)"/';
        if (preg_match($regex, $response, $matches)) {
            $status = trim($matches[1]);
            $username = $matches[2];
        
            echo "[{$hijau}+{$reset}] Status: {$hijau}{$status}{$reset} | user: {$hijau}{$username}{$reset}\n";
        } else {
            
            echo "[{$merah}-{$reset}] {$merah}Not found.{$reset}\n";
        }
    }
}
$cyan = "\033[0;36m";
$hijau = "\033[0;32m"; 
$merah = "\033[0;31m"; 
$reset = "\033[0m";
$banner = "
{$cyan}
____ ____ _  _ ___     ___  _  _ ____ ___ ____    ___  ____ ___    ___ ____ _    ____ ____ ____ ____ _  _ 
[__  |___ |\ | |  \    |__] |__| |  |  |  |  |    |__] |  |  |      |  |___ |    |___ | __ |__/ |__| |\/| 
___] |___ | \| |__/    |    |  | |__|  |  |__|    |__] |__|  |      |  |___ |___ |___ |__] |  \ |  | |  | 
                                                                    by namikulaufa{$reset}
";

echo $banner;

echo "Jumlah request: ";
$jumlah_requests = (int) readline();

// ganti chat ID dan path foto
$chat_id = '5075118527';
/* kalau untuk path, contoh:
- linux: /home/namikulaufa/foto.jpg
- android: /sdcard/blabla/foto.jpg
- windows: c:\users\namikulaufa\downloads\koleksi\foto.jpg  */
$path_photo = '/root/Downloads/istockphoto-522344723-1024x1024.jpg';

sendPhoto($chat_id, $path_photo, $jumlah_requests, $hijau, $merah, $reset);
?>
