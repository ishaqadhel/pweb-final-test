<?php
    require_once 'core/init.php';  

    /* if auth is false redirect to login */
    if ( !Session::exists('email') )
    {
        Session::flash('login', 'Anda harus Login');
        header('Location: login.php');
    }

    if ( $user->getRole(Session::get('email')) != 'admin' )
    {
        header('Location: index.php');
    }

    require_once 'components/header.php';

    if (Input::get('submit'))
    {
        $validation = new Validation();

        $validation = $validation->check(array(
            'email' => array(
                'required'=>true,
                'min'=>3,
            ),
            'password' => array(
                'required'=>true,
                'min'=>8,
            ),
            'name' => array(
                'required'=>true,
            ),
        ));

        if ($user->checkEmail(Input::get('email')))
        {
            $errors[] = 'email sudah terdaftar';
        }
        else
        {
            if ($validation->passed())
            {
                $user->register(array(
                    'email' => Input::get('email'),
                    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                    'name' => Input::get('name'),
                    'role' => 'parent',
                    ));

                Session::flash('admin-parent-index', 'Selamat! anda berhasil membuat akun orangtua!');
                header('Location: admin-parent-index.php');
            }
            else
            {
                $errors = $validation->errors();
            }
        }
    }

    error_reporting(-1);
?>

<div class="h-screen flex overflow-hidden bg-gray-100">
    <div
        class="fixed inset-0 flex z-40 md:hidden"
        role="dialog"
        aria-modal="true"
    >
        <div
            class="fixed inset-0 bg-gray-600 bg-opacity-75"
            aria-hidden="true"
        ></div>

        <div class="flex-shrink-0 w-14"></div>
    </div>

    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div
                class="flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white"
            >
                <div class="flex-1 flex flex-col pt-10 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <a href="#" class="font-semibold pl-2"
                            >AdminSekolah.net</a
                        >
                    </div>
                    <nav class="mt-5 flex-1 px-2 bg-white space-y-1 py-4">
                        <a
                            href="/admin-index.php"
                            class="bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-4 text-sm font-medium rounded-md"
                        >
                            <svg
                                class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-6 w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                            </svg>
                            Dashboard
                        </a>

                        <a
                            href="/admin-parent-index.php"
                            class="bg-gradient-to-r from-sky-700 to-sky-400 text-white group flex items-center px-2 py-4 text-sm font-semibold rounded-md"
                        >
                            <svg
                                class="text-white mr-3 flex-shrink-0 h-6 w-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                                />
                            </svg>
                            Manajemen Orang Tua
                        </a>

                        <a
                            href="#"
                            class="bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-4 text-sm font-medium rounded-md"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="text-gray-400 group-hover:text-gray-700 mr-3 flex-shrink-0 h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                                />
                            </svg>
                            Manajemen Tagihan Sekolah
                        </a>

                        <a
                            href="/logout.php"
                            class="bg-white text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-4 text-sm font-medium rounded-md"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="text-gray-400 group-hover:text-gray-700 mr-3 flex-shrink-0 h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                            Logout
                        </a>
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                    <a href="#" class="flex-shrink-0 w-full group block">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p
                                    class="text-sm font-medium text-gray-700 group-hover:text-gray-900"
                                >
                                    admin
                                </p>
                                <p
                                    class="text-xs font-medium text-gray-500 group-hover:text-gray-700"
                                >
                                    View profile
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
            <button
                type="button"
                class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
            >
                <span class="sr-only">Open sidebar</span>
                <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
        </div>
        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div
                    class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 pt-5 font-semibold text-lg text-gray-600"
                >
                    <a href="#" class="text-lg font-semibold text-gray-400">
                        Admin
                    </a>
                    / Manajemen Orang Tua
                </div>
                <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 md:px-8">
                    <h1 class="text-2xl font-semibold text-gray-900">Formulir Akun Orang Tua Murid</h1><br>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Replace with your content -->
                    <div class="flex flex-col py-1">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b bg-white border-gray-200 sm:rounded-lg">
                                    <form action="admin-parent-create.php" method="post">
                                        <div class="py-4 px-8">
                                            <div class="mb-4">
                                                <label class="block text-grey-darker text-sm font-bold mb-2">Nama
                                                    Lengkap</label>
                                                <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                                                    name="name" id="name" placeholder="Masukkan Nama Lengkap Anda">
                                            </div>

                                            <div class="mb-4">
                                                <label class="block text-grey-darker text-sm font-bold mb-2">Email</label>
                                                <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="email"
                                                    name="email" id="email" placeholder="Masukkan Alamat Email Anda">
                                            </div>
        
                                            <div class="mb-4">
                                                <label class="block text-grey-darker text-sm font-bold mb-2">Password</label>
                                                <input class=" border rounded w-full py-2 px-3 text-grey-darker"
                                                    type="password" name="password" id="password" placeholder="Masukkan Password Anda">
                                                <p id=error_intake_year></p>
                                            </div>
                                            <div class="mb-4">
                                                <button
                                                    type='submit'
                                                    name="submit"
                                                    value='RegisterAccountParent'
                                                    class="mb-2 mx-0 rounded-md py-2 px-5 bg-gradient-to-r from-sky-700 to-sky-400 hover:bg-blue-700 text-white font-bold">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /End replace -->
                </div>
            </div>
        </main>
    </div>
</div>


<?php require_once 'components/footer.php'; ?>  
