<?php


function logregCallError($e) {
    if ($e === 'wrong_password') {
        $stmt = 'wrong password bro';
    } else if ($e === 'no_user') {
        $stmt = 'wrong username bro';
    } else if ($e === 'registration_failed') {
        $stmt = 'registration failed';
    } else if ($e === 'existing_user') {
        $stmt = 'someones already got that bro';
    } else {
        $stmt = 'error occured, please try again';
    }
    echo '
        <div id="error-box" class="flex-row center-hor">
            <h1><i class="fa-solid fa-circle-exclamation error-icon"></i> ' . $stmt . '</h1>
        </div>
    ';
}

function loadHeader() {
    echo '
<header class="flex-row center-hor center-vert height-20 width-100">
    <div class="width-40">
        <h1>logo</h1>
    </div>
    <nav class="flex-row center-hor width-40">
        <a class="button">home</a>
        <a class="button" onclick="logout()">logout</a>
    </nav>
</header>
    ';
}
function loadFooter() {
    echo '
<header class="flex-row center-hor center-vert height-20 width-100">
    <div class="width-40">
        <h1>logo</h1>
    </div>
    <nav class="flex-row center-hor width-40">
        <a class="button">home</a>
        <a class="button" onclick="logout()">logout</a>
    </nav>
</header>
    ';
}

