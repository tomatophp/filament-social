<?php

return [
    /*
     * Socialite Providers
     */
    "providers" => [
        "google",
        "github",
        "discord",
        "facebook",
        "twitter-oauth-2",
        "snapchat",
    ],

    /*
     * Redirect To The Following Panel After Login
     */
    "panel" => "admin",


    /*
     * Notification Settings
     */
    "notification" => [
        "discord" => true,
    ],
];
