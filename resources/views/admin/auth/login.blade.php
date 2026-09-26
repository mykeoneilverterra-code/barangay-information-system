<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Admin Login | Barangay San Antonio
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


<body class="admin-login-body">


<div class="admin-login-page">


    <div class="admin-login-card">


        {{-- =====================================================
            BRAND
        ====================================================== --}}
        <div class="admin-login-brand">

            <div class="admin-login-brand-mark">
                BI
            </div>


            <div>

                <strong>
                    Barangay San Antonio
                </strong>

                <span>
                    Information System
                </span>

            </div>

        </div>



        {{-- =====================================================
            HEADING
        ====================================================== --}}
        <div class="admin-login-heading">

            <p>
                ADMINISTRATION
            </p>

            <h1>
                Admin Sign In
            </h1>

            <span>
                Sign in to access the barangay administration system.
            </span>

        </div>



        {{-- =====================================================
            SUCCESS MESSAGE
        ====================================================== --}}
        @if(session('success'))

            <div class="admin-login-success">

                {{ session('success') }}

            </div>

        @endif



        {{-- =====================================================
            GENERAL ERROR
        ====================================================== --}}
        @if($errors->has('email'))

            <div class="admin-login-error">

                {{ $errors->first('email') }}

            </div>

        @endif



        {{-- =====================================================
            LOGIN FORM
        ====================================================== --}}
        <form
            action="{{ route('admin.login.submit') }}"
            method="POST"
            class="admin-login-form"
        >

            @csrf



            {{-- Email --}}
            <div class="admin-login-field">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="Enter admin email"
                    autocomplete="email"
                    required
                    autofocus
                >

            </div>



            {{-- Password --}}
            <div class="admin-login-field">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    required
                >

                @error('password')

                    <span class="admin-login-field-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>



            {{-- Remember --}}
            <label class="admin-login-remember">

                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                >

                <span>
                    Remember me
                </span>

            </label>



            {{-- Submit --}}
            <button
                type="submit"
                class="admin-login-submit"
            >
                Sign In
            </button>

        </form>



        {{-- =====================================================
            PORTAL LINK
        ====================================================== --}}
        <div class="admin-login-footer">

            <span>
                Resident account?
            </span>

            <a href="{{ route('resident.login') }}">
                Go to Resident Portal
            </a>

        </div>

    </div>

</div>


</body>

</html>