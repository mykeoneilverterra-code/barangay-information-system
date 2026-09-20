<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Resident Login | Barangay San Antonio
    </title>


    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap"
        rel="stylesheet"
    >


    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body>

<div class="resident-login-page">


    <div class="resident-login-card">


        {{-- Brand --}}
        <div class="resident-login-brand">

            <div class="resident-login-logo">
                BI
            </div>


            <div>

                <strong>
                    Barangay San Antonio
                </strong>

                <span>
                    Resident Portal
                </span>

            </div>

        </div>


        {{-- Header --}}
        <div class="resident-login-heading">

            <p>
                RESIDENT ACCESS
            </p>

            <h1>
                Welcome back
            </h1>

            <span>
                Sign in to access your barangay resident account.
            </span>

        </div>


        {{-- Errors --}}
        @if($errors->any())

            <div class="resident-login-error">

                {{ $errors->first() }}

            </div>

        @endif


        {{-- Login Form --}}
        <form
            action="{{ route('resident.login.submit') }}"
            method="POST"
            class="resident-login-form"
        >

            @csrf


            <div class="resident-login-field">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email address"
                    required
                    autofocus
                >

            </div>


            <div class="resident-login-field">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <label class="resident-remember">

                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                <span>
                    Remember me
                </span>

            </label>


            <button
                type="submit"
                class="resident-login-button"
            >
                Sign In
            </button>

        </form>


        <div class="resident-login-note">

            Only registered residents with an activated account
            can access the Resident Portal.

        </div>

    </div>

</div>

</body>

</html>