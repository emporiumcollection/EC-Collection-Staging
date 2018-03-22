<?php

return [

    'projectId'     => env('AIRBRAKE_PROJECT_ID'),
    'projectKey'    => env('AIRBRAKE_PROJECT_KEY'),
    'environment'   => env('APP_ENV'),

    //leave the following options empty to use defaults

    'appVersion'    => '',
    'host'          => '',
    'rootDirectory' => '',
    'httpClient'    => '',

];
