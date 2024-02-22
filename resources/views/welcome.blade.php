<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AI-Doctor-Assistant </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="">
    <meta name="description" content="The Medical Diagnosis Assistance System is a web application designed to assist doctors in diagnosing medical conditions more efficiently.">
    <meta property="og:description" content="The Medical Diagnosis Assistance System is a web application designed to assist doctors in diagnosing medical conditions more efficiently.">
    <meta property="twitter:description" content="The Medical Diagnosis Assistance System is a web application designed to assist doctors in diagnosing medical conditions more efficiently.">
    <meta name="description" content="نظام مساعدة التشخيص الطبي هو تطبيق ويب مصمم لمساعدة الأطباء في تشخيص الحالات الطبية بكفاءة أكبر.">
    <meta property="og:description" content="نظام مساعدة التشخيص الطبي هو تطبيق ويب مصمم لمساعدة الأطباء في تشخيص الحالات الطبية بكفاءة أكبر.">
    <meta property="twitter:description" content="نظام مساعدة التشخيص الطبي هو تطبيق ويب مصمم لمساعدة الأطباء في تشخيص الحالات الطبية بكفاءة أكبر.">
    <meta name="keywords" content="Medical Diagnosis, Diagnosis Assistance, Doctors, Medical Conditions, Healthcare, Web Application, Efficient Diagnosis, نظام المساعدة في تشخيص الأمراض، الطبي، التشخيص الطبي، الذكاء الصناعي، الأطباء، تشخيص الأمراض، الطب، الأمراض الطبية، Medical Diagnosis Assistance System, Medical, Diagnosis, AI, Doctors, Disease Diagnosis, Medicine, Medical Conditions, تشخيص طبي، مساعدة في التشخيص، أطباء، حالات طبية، رعاية صحية، تطبيق ويب، تشخيص فعّال">

    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&family=Cairo:wght@200&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Roboto:wght@100&display=swap"
        rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="../css/app.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/robotDoctor-logo.png') }}">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
          tailwind.config = {
            theme: {
              extend: {
                colors: {
                  clifford: '#da373d',
                }
              }
            }
          }
        </script>
    @vite(['resources/js/app.js'])

</head>

<body class="antialiased">
    <div id="app">
        <!-- Vue.js components will be processed here. -->
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>
