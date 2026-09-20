<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Resident Portal
    </title>


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body>

<div class="resident-placeholder-page">

    <div class="resident-placeholder-card">

        <span class="resident-placeholder-badge">
            LOGIN SUCCESSFUL
        </span>


        <h1>
            Welcome,
            {{ auth()->user()->resident->full_name }}
        </h1>


        <p>
            Resident Number:
            <strong>
                {{ auth()->user()->resident->resident_number }}
            </strong>
        </p>


        <p>
            Your Resident Portal account is now successfully
            linked to your barangay resident record.
        </p>


        <form
            action="{{ route('resident.logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="resident-login-button"
            >
                Logout
            </button>

        </form>

    </div>

</div>

</body>

</html>