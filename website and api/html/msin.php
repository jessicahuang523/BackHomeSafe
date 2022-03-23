
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/page-signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
	<main class="form-signin">
	  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
		<img class="mb-4" src="images/txt.png" alt="" width="72" height="57">
		<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

		<div class="form-floating">
		  <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
		  <label for="floatingInput">Email address</label>
		</div>
		<div class="form-floating">
		  <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
		  <label for="floatingPassword">Password</label>
		</div>

		<div class="checkbox mb-3">
		  <label>
			<input type="checkbox" name="remember-me"> Remember me
		  </label>
		</div>
		<div class="checkbox mb-3">
		  <p>Have Not An Account? <a href="msup.php">Siginup Here</a></p>
		</div>
		<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted">&copy; 2021 Company Name</p>
	  </form>
	</main>
  </body>
</html>
