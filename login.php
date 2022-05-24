<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./src/style/index.css">
    <link rel="stylesheet" href="./src/style/background/colors.css">
    <link rel="stylesheet" href="./src/style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="sd-background m-0">
            </div>
            <div class="sd-login">
                <div class="content-login my-5 mx-5">
                    <h2 class="text-center">Login Form</h2>
                    <p class="text-center text-secondary">Silahkan login untuk menggunakan aplikasi ini</p>

                    <form action="" class="form-login w-75">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address <b style="color: red;">*</b></label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" require>
                                <span class="input-group-text" id="emailHelp">@example.com</span>
                                <div id="emailHelp" class="form-text">Kami tidak akan pernah membagikan email Anda kepada orang lain</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username <b style="color: red;">*</b></label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" require>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password <b style="color: red;">*</b></label>
                            <input type="password" class="form-control" id="exampleInputPassword1" require>
                        </div>
                        <button type="submit" class="btn btn-purple w-75" >Submit</button>
                        <button type="button" class="btn btn-outline-danger" style="width: 24%;">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>