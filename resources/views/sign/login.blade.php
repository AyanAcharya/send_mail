@include('sign/header')

<body class="bg-blue-600">

    <div class=" mx-1 lg:mx-6 max-w-full lg:flex">
        <div class="grid grid-cols-1 w-full justify-center lg:flex">
            {{-- word container --}}
            <div class="px-4 pt-10 lg:pt-40 grid justify-center"> 
                <img src="{{ asset('assets/Logo-White.png') }}" alt="eventify">
                <p class="text-white w-auto sm:w-96 text-xs md:text-base mt-2">Start creating beautiful event apps with
                    our easy-to-use event app builder. Build customized apps and instantly publish them with no design
                    or coding skills required.</p>
            </div>


            {{-- login container --}}
            <div class="flex justify-center  pt-5 lg:pt-24 lg:w-2/4 basis-3/4">
                <form id="login_form"
                    class="max-w-sm pb-10 p-4 bg-white grid justfy-center rounded-xl w-9/12 lg: max-w-xl lg:p-24 drop-shadow-xl hover:drop-shadow-2xl	shadow-5xl border border-purple-400 shadow-purple-500 cursor-move ">
                    <h2
                        class=" text-2xl py-5 sm:text-5xl text-center  sm:pb-20 font-bold text-sky-700 decoration-solid underline">
                        Login</h2>
                    <label for="email" class="text-2xl text-sky-600 pb-4 font-semibold">Email</label>
                    <input type="text" name="email" id="email"
                        class="  text-sm sm:text-base  w-full h-12 border border-blue-300 rounded-lg pl-4 placeholder:font-thin "
                        placeholder="Enter Email">
                    <span class="error email_err text-red-400 text-center"></span>
                    <label for="password" class="text-2xl text-sky-600 font-semibold py-4">Password</label>
                    <input type="password" name="password"
                        class="  text-sm sm:text-base w-full h-12 border border-blue-300  rounded-lg pl-4 placeholder:font-thin"
                        placeholder="Enter Your Password">
                    <span class="error password_err text-red-400 text-center"></span>
                    <button type="submit"
                        class=" pt-2 bg-blue-500 rounded-full w-auto text-white mt-12 sm:p-3 text-2xl shadow border border-blue-700 font-semibold ">Login</button>
                    <p class="result text-center text-emerald-600"></p>
                </form>

            </div>
        </div>
    </div>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
