
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/icons/logo.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">--}}
    <link rel="manifest" href="{{asset('assets/manifest.json')}}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            width: 100vw;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(to right ,lightblue, white, lightblue);
        }
        .container{
            padding: 10px;
            width: 700px;
            height: 500px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0px 0px 10px black;
            overflow: hidden;
            animation: aa 0.75s 1 linear;
        }
        @keyframes aa {
            from{transform: scale(0);}
            to{transform: scale(1);}
        }
        .login{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .left1 , .right1{
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .left1{
            background-color: rgb(86, 177, 238);
            border-radius: 20px 130px 130px 20px;
            color: white;
            gap: 10px;
        }
        .left1 button , .right2 button{
            width: 190px;
            height: 40px;
            border-radius: 10px;
            background-color: transparent;
            border: 2px solid white;
            color: white;
            transition: 0.3s;
        }
        .left1 button:hover , .right2 button:hover{
            background-color: white ;
            color:  rgb(86, 177, 238);
            transition: 0.3s;
        }
        .right1{
            gap: 10px;
        }
        .right1 h2{
            font-size: 30px;
        }
        .right1 input{
            background-color:rgb(222, 220, 220);
            width: 100%;
            height: 40px;
            outline: none;
            border: none;
            border-radius: 10px;
            padding: 10px;
        }
        .inputs-container{
            width: 270px;
            height: 90px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }


        .right1 button{
            width: 270px;
            height: 40px;
            background-color: rgb(86, 177, 238);
            border: none;
            color: white;
            border-radius: 10px;
        }
        .register{
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .left2 , .right2{
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        .right2{
            background-color: rgb(86, 177, 238);
            border-radius:  130px 20px 20px 130px ;
            color: white;
            gap: 10px;
        }

        .left2 input{
            background-color:rgb(222, 220, 220);
            width: 90%;
            height: 40px;
            outline: none;
            border: none;
            border-radius: 10px;
            padding: 10px;
        }
        .left2{
            gap: 10px;
        }
        .left2 h2{
            font-size: 30px;
        }
        .inputs-con{
            width: 270px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            position: relative;
            gap: 10px;
        }
        .holder{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            background-color:rgb(222, 220, 220);
            padding: 0px 10px 0px 0px;
            border-radius: 10px;
        }

        .left2 button{
            width: 270px;
            height: 40px;
            background-color: rgb(86, 177, 238);
            border: none;
            color: white;
            border-radius: 10px;
        }
        .loginmation{
            animation: up 1s 1 forwards;
        }
        @keyframes up {
            from{}
            to{transform: translateY(-500px);}
        }
        .registermation{
            animation: dowm 1s 1 forwards;
        }
        @keyframes dowm {
            from{transform: translateY(-500px);}
            to{transform: translateY(0px);}
        }




        @media (max-width: 575px) {
            .container{
                width: 330px;
            }
            .login{
                flex-direction: column;
            }
            .left1 , .right1{
                width: 100%;
                flex-direction: column;
            }
            .left1{
                border-radius: 20px 20px 50px 50px;
            }
            .register{
                flex-direction: column;
            }
            .left2 , .right2{
                width: 100%;
                flex-direction: column;
            }
            .left2 {
                margin-top: 10px;
            }
            .right2{
                border-radius: 50px 50px 20px 20px;
                margin-top: 20px;
            }

        }
        @media (min-width: 576px) and (max-width:768px) {
            .container{
                width: 490px;
            }
            .login{
                flex-direction: column;
            }
            .inputs-container{
                width: 70%;
            }
            .right1 button{
                width: 70%;

            }
            .left1 , .right1{
                width: 100%;
                flex-direction: column;
            }
            .left1{
                border-radius: 20px 20px 50px 50px;
            }
            .register{
                flex-direction: column;
            }
            .left2 , .right2{
                width: 100%;
                flex-direction: column;
            }
            .left2 {
                margin-top: 10px;
            }
            .right2{
                border-radius: 50px 50px 20px 20px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login"  id="login">
        <div class="left1">
            <h1>Hello , Welcome</h1>
            <p>Don't have an account?</p>
            <a href="{{route('home')}}"><button style="cursor: pointer;" id="btn1">  Contact Us</button> </a>
        </div>

        <form method="POST" action="{{route('login')}}" class="right1">
            @csrf
            <h2>login</h2>
            @foreach ($errors->all() as $error)
                <span style="color: red;">{{ $error }}</span>
            @endforeach
            <div class="inputs-container">
                <div class="holder">
                    <input type="text" name="username" placeholder="username" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="holder">
                    <input type="password" name="password" placeholder="password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
            </div>
            <button style="cursor: pointer;" type="submit">login</button>
        </form>
    </div>

{{--    <div class="register" id="register">--}}
{{--        <form class="left2" >--}}
{{--            <h2>Registration</h2>--}}
{{--            <div class="inputs-con">--}}
{{--                <div class="holder"><input type="text" placeholder="username" required><i class="fa-solid fa-user"></i></div>--}}
{{--                <div class="holder"><input type="text"  placeholder="Email" required><i class="fa-solid fa-envelope"></i></div>--}}
{{--                <div class="holder"><input type="password" placeholder="password" required><i class="fa-solid fa-lock"></i></div>--}}
{{--                <div class="holder"><input type="password" placeholder="confirm password" required><i class="fa-solid fa-lock"></i></div>--}}
{{--            </div>--}}
{{--            <button>Register</button>--}}
{{--        </form>--}}
{{--        <div class="right2">--}}
{{--            <h1>Welcome Back!</h1>--}}
{{--            <p>Already have an account?</p>--}}
{{--            <button id="btn2">Login</button>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

<script>
    // let btn1= document.getElementById("btn1");
    // let btn2= document.getElementById("btn2");
    // let login= document.getElementById("login");
    // let register= document.getElementById("register");
    // let color = document.querySelector(".color");
    // btn1.addEventListener("click",function(){
    //     login.classList.add("loginmation")
    //     register.classList.add("loginmation")
    //     login.classList.remove("registermation")
    //     register.classList.remove("registermation")
    // });
    // btn2.addEventListener("click",function(){
    //     login.classList.add("registermation")
    //     register.classList.add("registermation")
    //     login.classList.remove("loginmation")
    //     register.classList.remove("loginmation")
    // });
</script>
@include('sweetalert::alert')
</body>

</html>
