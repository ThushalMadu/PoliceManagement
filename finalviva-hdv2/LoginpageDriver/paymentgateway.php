<?php
include "../../finalviva-hdv2/db.php";
// if (!$_SESSION['loggedindriver']) {
//     header("location:index.php");
//     die;
// } else {
if (!isset($_SESSION)) {
    session_start();
}
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pay.css" />

</head>

<body>
    <div id="card-success" class="hidden">
        <i class="fa fa-check"></i>
        <p>Payment Successful!</p>
    </div>
    <div id="form-errors" class="hidden">
        <i class="fa fa-exclamation-triangle"></i>
        <p id="card-error">Card error</p>
    </div>
    <div id="form-container">

        <div id="card-front">
            <div id="shadow"></div>
            <div id="image-container">
                <span id="amount">paying: <strong></strong></span>
                <span id="card-image">

                </span>
            </div>
            <!--- end card image container --->
            <form action="paycard.php" method="get">
                <label for="card-number">
                    Card Number
                </label>
                <input type="text" id="card-number" placeholder="1234 5678 9101 1112" length="16">
                <div id="cardholder-container">
                    <label for="card-holder">Card Holder
                    </label>
                    <input type="text" id="card-holder" placeholder="e.g. John Doe" />
                </div>
                <!--- end card holder container --->
                <div id="exp-container">
                    <label for="card-exp">
                        Expiration
                    </label>
                    <input id="card-month" type="text" placeholder="MM" length="2">
                    <input id="card-year" type="text" placeholder="YY" length="2">
                </div>
                <div id="cvc-container">
                    <label for="card-cvc"> CVC/CVV</label>
                    <input id="card-cvc" placeholder="XXX-X" type="text" min-length="3" max-length="4">
                    <p>Last 3 or 4 digits</p>
                </div>
                <!--- end CVC container --->
                <!--- end exp container --->
        </div>
        <!--- end card front --->
        <div id="card-back">
            <div id="card-stripe">
            </div>

        </div>
        <!--- end card back --->
        <input type="text" id="card-token" />
        <button type="submit" id="card-btn">Submit</button>
        </form>

    </div>
    <!--- end form container --->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://use.fontawesome.com/f1e0bf0cbc.js"></script>
    <script src="pay.js"></script>
</body>

</html>