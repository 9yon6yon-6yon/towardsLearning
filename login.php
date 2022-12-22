<html>
  <head>
    <link
      href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta
      name="viewport"
      content="width=device-width,initial-scale=1,maximum-scale=1"
    />
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
    </style>
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"
      defer
    ></script>
  </head>

  <body>
    <header>
      <a href="#" class="logo">
        <img src="img/logo.png">
      </a>
  
      <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#categories">For Teachers</a></li>
        <li><a href="#courses">For Students</a></li>
        <li><a href="login.php">Log in</a></li>
        <li><a href="signup.php">Sign up</a></li>
      </ul>
  
      <div class="header-icons">
        <a href="#"><i class='bx bx-user'></i></a>
        
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>
  <div  class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div
      class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1"
    >
      <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
        <div
          class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
          style="background-image: url('img/login.png'); "
        ></div>
      </div>
      <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
        <div>
          <img
            src="img/logo.png"
            class="w-32 mx-auto"
          />
        </div>
        <div class="mt-12 flex flex-col items-center">
          <h1 class="text-2xl xl:text-3xl font-extrabold">
            Sign In
          </h1>
          <div class="w-full flex-1 mt-8">
            

            <div class="my-12 border-b text-center">
              <div
                class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium bg-white transform translate-y-1/2"
              >
                Enter email & Password
              </div>
            </div>
            <form method="POST" action="process.php">
            <div class="mx-auto max-w-xs">
              
              <input
                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                type="email"
                placeholder="Email" name="email"
              />
              <input
                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                type="password"
                placeholder="Password" name="password"
              />
              
              <button
                class="mt-5 tracking-wide font-semibold bg-indigo-500 text-gray-100 w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none" type="submit" name="login_user"
              >
              
                <span class="ml-3">
                  Sign In
                </span>
              </button>
              <p class="mt-6 text-xs text-gray-600 text-center">
                Dont have an account?
                <a href="signup.php" class="border-b border-gray-500 border-dotted">
                  Create Now!
                </a>
              </p>
              <p class="mt-6 text-xs text-gray-600 text-center">Or, login as
              <a href="admin-login.php" class="border-b border-gray-500 border-dotted"> admin</a>
                </p>
            </div>
          </form>
          </div>
        </div>
      </div>
      
    </div>
    </div>
    
  </body>
</html>
