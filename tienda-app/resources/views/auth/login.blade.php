
  {{-- <div class="container mx-auto ">

    <div class="center">
      <x-auth-session-status class="mb-4" :status="session('status')" />
        <form class="form" method="POST" action="{{ route('login') }}">
            <div class="input-block">
                <input class="input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" id="email">
                <label for="email">Correo Electronico</label>
            </div>
            <div class="input-block">
                <input class="input" type="password" id="pass" type="password"
                name="password"
                required autocomplete="current-password" >
                <label for="pass">Contraseña</label>
            </div>
            
            <div class="input-block">
<span class="forgot">            @if (Route::has('password.request'))
<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
    {{ __('Forgot your password?') }}
</a>
@endif</span>
            <button> {{ __('Log in') }}</button>
        </div>
        
        </form>
        
    </div>
    <div class="right">
        <div class="img"></div>

    </div>


<style>
    .container {
display: flex;
width: 520px;
height: 500px;
max-width: 99%;
align-items: center;
justify-content: center;
position: relative;
overflow: hidden;
background-color: #ffffff25;
border-radius: 15px;
box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.03);
border: 0.1px solid rgba(128, 128, 128, 0.178);
}

.left {
width: 66%;
height: 100%;
}

.form {
display: flex;
flex-direction: column;
justify-content: center;
height: 100%;
width: 100%;
left: 0;
backdrop-filter: blur(20px);
position: relative;
}

.form::before {
position: absolute;
content: "";
width: 40%;
height: 40%;
right: 1%;
z-index: -1;
background: radial-gradient(
circle,
rgb(194, 13, 170) 20%,
rgb(26, 186, 235) 60%,

rgb(26, 186, 235) 100%
);
filter: blur(70px);
border-radius: 50%;
}

.right {
width: 34%;
height: 100%;
}

.img {
width: 100%;
height: 100%;
}

.container::after {
position: absolute;
content: "";
width: 80%;
height: 80%;
right: -40%;
background: rgb(157, 173, 203);
background: radial-gradient(
circle,
rgba(157, 173, 203, 1) 61%,
rgba(99, 122, 159, 1) 100%
);
border-radius: 50%;
z-index: -1;
}

.input,
button {
background: rgba(253, 253, 253, 0);
outline: none;
border: 1px solid rgba(255, 0, 0, 0);
border-radius: 0.5rem;
padding: 10px;
margin: 10px auto;
width: 80%;
display: block;
color: #425981;
font-weight: 500;
font-size: 1.1em;
}

.input-block {
position: relative;
}

label {
position: absolute;
left: 15%;
top: 37%;
pointer-events: none;
color: gray;
}

.forgot {
display: block;
margin: 5px 0 10px 0;
margin-left: 35px;
color: #5e7eb6;
font-size: 0.9em;
}

.input:focus + label,
.input:valid + label {
transform: translateY(-120%) scale(0.9);
transition: all 0.4s;
}

button {
background-color: #5e7eb6;
color: white;
font-size: medium;
box-shadow: 2px 4px 8px rgba(70, 70, 70, 0.178);
}

a {
color: #5e7eb6;
}

.input {
box-shadow: inset 4px 4px 4px rgba(165, 163, 163, 0.315),
4px 4px 4px rgba(218, 218, 218, 0.13);
}

</style>

</div> --}}
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>


  </x-guest-layout>



