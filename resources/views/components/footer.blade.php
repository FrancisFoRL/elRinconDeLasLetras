<footer class="container-fluid p-5">
    <div class="row align-items-center pb-5">
        <div class="col-3 col-md-4 col-lg-3 col-xl-3 col-xxl-4">
            <div class="line mx-1 mx-md-3 mx-xl-5"></div>
        </div>
        <div class="col-6 col-md-4 col-lg-6 col-xl-6 col-xxl-4 d-flex align-items-center justify-content-center">
            <i class="fa-brands fa-facebook mx-2 mx-lg-4 mx-xl-5 iconos" style="color:#3b5998 "></i>
            <i class="fa-brands fa-instagram mx-2 mx-lg-4 mx-xl-5 iconos" id="insta"></i>
            <i class="fa-brands fa-youtube mx-2 mx-lg-4 mx-xl-5 iconos" style="color:#c4302b"></i>
            <i class="fa-brands fa-twitter mx-2 mx-lg-4 mx-xl-5 iconos" style="color:#00acee"></i>
            <i class="fa-brands fa-linkedin-in mx-2 mx-lg-4 mx-xl-5 iconos" style="color:#0072b1"></i>
        </div>
        <div class="col-3 col-md-4 col-lg-3 col-xl-3 col-xxl-4">
            <div class="line mx-1 mx-md-3 mx-xl-5"></div>
        </div>
    </div>
    <div class="text-center mt-2">
        <img src="{{ Storage::url('Logo.svg') }}" alt="El Rincón de las letras" width="70" height="70">
        <p class="m-0 mt-3" id="copy" style="color:#D9D9D9;">Copyright © 2023 El Rincón de las Letras</p>
    </div>
    <div class="mt-2 d-flex justify-content-center fs-5 pb-5 pb-lg-0 align-items-center" style="color:#D9D9D9;">
        <a href="" class="text-decoration-none">
            <span>Mapa web</span>
        </a>
        <span class="mx-1 separator"> | </span>
        <a href="" class="text-decoration-none">
            <span>Información Legal</span>
        </a>
        <span class="mx-1 separator"> | </span>
        <a href="" class="text-decoration-none">
            <span>Política de privacidad</span>
        </a>
        <span class="mx-1 separator"> | </span>
        <a href="" class="text-decoration-none">
            <span>Contacto</span>
        </a>
    </div>
</footer>

<style>
    footer {
        background-color: #212121;
        font-family: 'Roboto';
    }

    .line {
        height: 2px;
        background-color: #D9D9D9;
    }

    footer i {
        color: #D9D9D9;
        font-size: 30px;
    }

    footer a{
        color: #D9D9D9;
    }

    footer a:hover{
        color: #6D9886;
    }

    #insta {
        background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    @media(max-width:576px) {
        .iconos {
            font-size: 15px !important;
        }

        footer a{
            font-size: 2vw;
        }

        #copy{
            font-size: 2vw;
        }

        .separator{
            font-size: 2vw;
        }
    }

    @media(max-width:768px) {
        .iconos {
            font-size: 23px;
        }
    }
</style>
