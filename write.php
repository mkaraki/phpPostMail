<!DOCTYPE html>
<?php
require_once __DIR__ . '/auth.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write mail</title>
    <style>
        form>div {
            margin-bottom: 5px;
        }

        label {
            display: inline-block;
            width: 100px;
        }

        .if {
            margin-left: 100px;
        }

        input[type="text"],
        textarea {
            width: calc(100vw - 160px);
        }
    </style>
</head>

<body>
    <form action="send.php" method="post" onsubmit="return confirm('Are you sure?')">
        <div>
            <label for="from">From</label>
            <input type="text" name="from" id="from" value="<?= $rawUser ?>" readonly>
        </div>
        <div>
            <label for="via">Via</label>
            <input type="text" name="via" id="via" value="<?= $servServ ?>" readonly>
        </div>
        <div>
            <label for="to">To</label>
            <input type="text" name="to" id="to">
            <div class="if">
                <small><code>;</code> to specify multiple people</small>
            </div>
        </div>
        <div>
            <label for="cc">Cc</label>
            <input type="text" name="cc" id="cc">
            <div class="if">
                <small><code>;</code> to specify multiple people</small>
            </div>
        </div>
        <div>
            <label for="bcc">Bcc</label>
            <input type="text" name="bcc" id="bcc">
            <div class="if">
                <small><code>;</code> to specify multiple people</small>
            </div>
        </div>
        <hr />
        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject">
        </div>
        <br />
        <div>
            <label for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="50"></textarea>
        </div>
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
</body>

</html>