<?php
$app->get('/mediamanager/qbittorrent/test', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    if ($MediaManager->auth->checkAccess("ADMIN-CONFIG")) {
        $MediaManager->api->setAPIResponseData($MediaManager->testConnectionqBittorrent());
    }
    $response->getBody()->write(json_encode($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});

$app->get('/mediamanager/qbittorrent/queue', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    $DownloadQueueWidget = new DownloadQueueWidget($MediaManager);
    if ($MediaManager->auth->checkAccess($DownloadQueueWidget->widgetConfig['auth'] ?? null)) {
        $MediaManager->getqBittorrentQueue();
    }
    $response->getBody()->write(json_encode($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});