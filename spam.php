<?php
$merah = "\033[0;31m";
$kuning = "\033[1;33m";
$hijau = "\033[0;32m";
$reset = "\033[0m";

// ganti bot token
$bot_token = '6527414210:AAHnGyN8QDYy5edH7i_GC3-foSp1uh4LXvU';
// ganti chat id
$chatid = '5075118527';

$banner = "
{$kuning}
____ ____ _  _ ___     ___ ____ _  _ ___    ___  ____ ___   ___ ____ _    ____ ____ ____ ____ _  _ 
[__  |___ |\ | |  \\     |  |___  \\/   |     |__] |  |  |      |  |___ |    |___ | __ |__/ |__| |\\/| 
___] |___ | \\| |__/     |  |___ _/\\_  |     |__] |__|  |      |  |___ |___ |___ |__] |  \\ |  | |  | 
                                                                by namikulaufa                                  
{$reset}
";

echo $banner;

echo "Pesan: ";
$pesan = readline();

echo "Jumlah request: ";
$jumlah_requests = (int) readline();

$curl = curl_init();

// menggunakan variabel $token dan $chatid
$url = "https://api.telegram.org/bot{$bot_token}/sendMessage?parse_mode=markdown&chat_id={$chatid}&text=" . urlencode($pesan);

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

for ($i = 0; $i < $jumlah_requests; $i++) {
    $response = curl_exec($curl);

    $respone = json_decode($response, true);
    if (isset($respone['ok']) && $respone['ok']) {

        $regex = '/"ok":([^,]+).*"username":"([^"]+)"/';
        if (preg_match($regex, $response, $matches)) {
            $status = trim($matches[1]);
            $username = $matches[2];
            echo "[{$hijau}+{$reset}] Status: {$hijau}{$status}{$reset} | User: {$hijau}{$username}{$reset}\n";
        } else {
            echo "[{$merah}-{$reset}] Not found.\n";
        }
    }
}
curl_close($curl);
?>
