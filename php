<?php

function getPastebinContent($rawUrl) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $rawUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "Gagal mengambil data Pastebin: " . curl_error($ch);
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return trim($result);
}

function getLandingPage($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "Gagal mengambil landing page: " . curl_error($ch);
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return $result;
}

$pastebinRawUrl = "https://raw.githubusercontent.com/berita-update4/hots/refs/heads/main/Situs66.id";

$landingPageUrl = getPastebinContent($pastebinRawUrl);

if ($landingPageUrl) {
    echo "URL Landing Page ditemukan: $landingPageUrl\n\n";
    $html = getLandingPage($landingPageUrl);
    if ($html) {
        echo "=== Konten Landing Page ===\n\n";
        echo substr($html, 0, 2000);
    }
}

?>
