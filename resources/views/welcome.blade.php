<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <form method="GET" id ="payment-form" action="{{  $paymentDevUrl }}">

                <input type="hidden" name="PID" value="{{  $PID }}" >

                <input type="hidden" name="MD"   value="{{  $MD }}">

                <input type="hidden" name="AMT" value="{{  $AMT }}">

                <input type="hidden" name="CRN" value="{{  $CRN }}">

                <input type="hidden" name="DT" value="{{  $DT }}">

                <input type="hidden" name="R1" value="{{  $R1 }}">

                <input type="hidden" name="R2" value="{{  $R2 }}">

                <input type="hidden" name="DV" value="{{  $DV }}">

                <input type="hidden" name="RU" value="{{  $RU }}">

                <input type="hidden" name="PRN" value="{{  $PRN }}">



                <input type="submit" value="Click to Pay">

            </form>
        </div>
    </body>
</html>
