<?php
    require_once 'core/init.php';  

    /* If Auth is True than redirect to index */
    if ( Session::exists('email') )
    {
        header('Location: index.php');
    }

    if ( Session::exists('login'))
    {
        echo Session::flash('login');
    }

    $errors = array();

    /* validation for login form */
    if (Input::get('submit'))
    {
        if( Token::check( Input::get('token')))
        {
            $validation = new Validation();

            $validation = $validation->check(array(
                'email' => array(
                    'required'=>true
                ),
                'password' => array(
                    'required'=>true
                )
            ));

            if ($validation->passed())
            {

                if ($user->checkEmail(Input::get('email')))
                {
                    if ( $user->login( Input::get('email'), Input::get('password') ) )
                    {
                            Session::set('email', Input::get('email'));
                            header('Location: index.php');
                    }
                    else
                    {
                        echo 'email atau password salah';
                    }
                }
                else
                {
                    $errors[] = 'email belum terdaftar';
                } 
                
            }
            else
            {
                $errors = $validation->errors();
            }
        }
    }

    require_once 'components/header.php';

    error_reporting(0);
?>

<!-- navbar -->
<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded-full">
    <div
        class="container flex flex-wrap justify-between items-center mx-auto"
    >
        <a href="#" class="flex">
            <span class="self-center text-lg font-bold text-black"
                >Admin Sekolah .NET</span
            >
        </a>
        <div class="flex md:order-2">
            <button
                type="button"
                class="text-white bg-black hover:bg-stone-800 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-3 md:mr-0"
            >
                Lihat Panduan Web
            </button>
            <button
                data-collapse-toggle="mobile-menu-4"
                type="button"
                class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu-4"
                aria-expanded="false"
            >
                <span class="sr-only">Open main menu</span>
                <svg
                    class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <svg
                    class="hidden w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
        </div>
        <div
            class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1"
            id="mobile-menu-4"
        >
            <ul
                class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium"
            >
                <li>
                    <a
                        href="#"
                        class="block py-2 pr-4 pl-3 text-gray-700"
                        >Landing Page</a
                    >
                </li>
                <li>
                    <a
                        href="#"
                        class="block py-2 pr-4 pl-3 text-gray-700"
                        >Kontak Sekolah</a
                    >
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- navbar ends -->
<section class="flex flex-col md:flex-row h-full items-center">
    <div
        class="bg-white w-full md:max-w-md lg:max-w-full md:mx-auto md:w-1/2 xl:w-1/2 h-screen px-6 lg:px-16 xl:px-12 flex items-center justify-center object-left"
    >
        <div class="w-full h-100">
            <h1
                class="text-4xl bg-clip-text text-transparent bg-gradient-to-br from-sky-500 to-indigo-600 md:text-3xl font-bold leading-loose mt-50"
            >
                Login
            </h1>
            <p class="text-3xl text-gray-500">
                Masukkan Email dan Password Untuk <br />
                Mengakses Aplikasi
            </p>

            <form class="mt-6" action="login.php" method="POST">
                <div>
                    <label class="block font-bold text-black-700"
                        >Email Address</label
                    >
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter Email Address"
                        class="w-3/4 px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-purple-500 focus:bg-white focus:outline-none"
                        autofocus
                        autocomplete
                        required
                    />
                </div>

                <div class="mt-4">
                    <label class="block font-bold text-black-700"
                        >Password</label
                    >
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter Password"
                        minlength="6"
                        class="w-3/4 px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-purple-500 focus:bg-white focus:outline-none"
                        required
                    />
                </div>

                <div class="text-left mt-2">
                    <a
                        href="#"
                        class="text-sm font-semibold text-gray-700 hover:text-purple-700 focus:text-purple-700"
                        >Forgot Password?</a
                    >
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <button
                    type="submit"
                    name="submit"
                    value="Login"
                    class="w-3/4 block bg-gradient-to-br from-sky-400 to-indigo-600 hover:bg-blue-400 focus:bg-purple-400 text-white font-semibold rounded-lg px-4 py-3 mt-6"
                >
                    SIGN IN
                </button>
            </form>

            <hr class="my-6 border-gray-300 w-3/4" />

            <p class="mt-8">
                Need an account?
                <a
                    href="#"
                    class="bg-clip-text text-transparent bg-gradient-to-br from-sky-500 to-indigo-600 hover:text-blue-700 font-bold"
                    >Kontak Pihak Sekolah</a
                >
            </p>

            <p class="text-sm text-gray-500 mt-12">
                &copy; 2021 PWEB D - All Rights Reserved.
            </p>
        </div>
    </div>
    <div class="bg-white hidden lg:block md:w-1/2 xl:w-1/2 h-screen">
        <img
            src="public/images/loz.jpeg"
            alt=""
            class="z-3 w-full h-full object-right-bottom object-contain"
        />
    </div>
</section>

<?php require_once 'components/footer.php'; ?>  
