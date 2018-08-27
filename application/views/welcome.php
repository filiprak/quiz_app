<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo (isset($page_title) ? $page_title : 'Quiz App - Login'); ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() . 'assets/favicon.png'; ?>"/>

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/welcome.css'; ?>">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/libs/jquery-2.2.4.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/libs/semantic-ui-2.3.3/semantic.min.js'; ?>"></script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700" rel="stylesheet">
</head>
<body>

<div class="ui text container">
    <h1 style="font-size: 80px">Welcome</h1>

    <h2>What's your <b>name</b> ? *</h2>
    <div class="ui massive transparent input border-bottom">
        <input class="red" type="text" placeholder="Type your answer here...">
    </div>

    <h2>What's your <b>email address</b> ? *</h2>
    <div class="ui massive transparent input border-bottom">
        <input class="red" type="text" placeholder="Type your answer here...">
    </div>

    <h2>Please select your <b>gender</b> (optional)</h2>
    <div class="ui massive buttons">
        <button class="ui basic orange button"><i class="icon male"></i>Male</button>
        <button class="ui basic orange button"><i class="icon female"></i>Female</button>
    </div>

    <h2>Please select your <b>age</b> *</h2>
    <div class="ui massive buttons">
        <button class="ui basic orange button">< 18</button>
        <button class="ui basic orange button">18 - 29</button>
        <button class="ui basic orange button">30 - 44</button>
        <button class="ui basic orange button">45 - 64</button>
        <button class="ui basic orange button">65+</button>
    </div>

    <div style="padding-top: 5em">
        <button class="ui orange very big button">Start Quiz<i class="chevron right icon"></i></button>
    </div>
</div>

</body>
</html>