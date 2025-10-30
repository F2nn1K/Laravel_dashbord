<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/sneat-1.0.0/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/sneat-1.0.0/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/sneat-1.0.0/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/sneat-1.0.0/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="/sneat-1.0.0/assets/vendor/css/pages/page-auth.css" />
    
    <!-- Custom CSS - Cores da Guiana -->
    <style>
        :root {
            --guiana-verde: #009E49;
            --guiana-amarelo: #FCD116;
            --guiana-vermelho: #CE1126;
        }
        
        body {
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        
        .authentication-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
        }
        
        .authentication-inner {
            width: 100%;
            max-width: 1200px;
            margin: 20px;
        }
        
        .card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border: none;
            display: flex;
            flex-direction: row;
            min-height: 600px;
        }
        
        .login-left {
            background: linear-gradient(135deg, var(--guiana-verde) 0%, #006B3D 100%);
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }
        
        .bandeira-container {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .bandeira-container img {
            max-width: 300px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 4px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-left h2 {
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .login-left p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .login-right {
            flex: 1;
            padding: 60px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .login-header h4 {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .login-header p {
            color: #7f8c8d;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--guiana-amarelo) 0%, #E8B000 100%);
            border: none;
            color: #000;
            font-weight: bold;
            padding: 12px;
            font-size: 1.1rem;
            transition: all 0.3s;
            border-radius: 8px;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #E8B000 0%, var(--guiana-amarelo) 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(252, 209, 22, 0.4);
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--guiana-verde);
            box-shadow: 0 0 0 0.2rem rgba(0, 158, 73, 0.15);
        }
        
        .form-label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        a {
            color: var(--guiana-verde);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        a:hover {
            color: var(--guiana-vermelho);
        }
        
        .divider {
            border-top: 3px solid var(--guiana-amarelo);
            width: 60px;
            margin: 15px auto;
        }
        
        @media (max-width: 992px) {
            .card {
                flex-direction: column;
            }
            
            .login-left, .login-right {
                flex: none;
                width: 100%;
            }
            
            .login-left {
                padding: 40px 20px;
            }
            
            .bandeira-container img {
                max-width: 200px;
            }
        }
    </style>
    
    <!-- Helpers -->
    <script src="/sneat-1.0.0/assets/vendor/js/helpers.js"></script>
    <script src="/sneat-1.0.0/assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper">
        <div class="authentication-inner">
            <div class="card">
                <!-- Lado Esquerdo - Bandeira e Boas-vindas -->
                <div class="login-left">
                    <div class="bandeira-container">
                        <img src="/img/guiana.png" alt="Bandeira da Guiana" />
                    </div>
                    <h2>Marudi Mountain</h2>
                    <div class="divider"></div>
                    <p>Sistema de Gestão de Vendas de Ouro</p>
                </div>

                <!-- Lado Direito - Formulário -->
                <div class="login-right">
                    <div class="login-header">
                        <h4>Bem-vindo! 👋</h4>
                        <p>Faça login para acessar o sistema</p>
                    </div>

                    <form id="frmAuth" action="#" method="POST">
                        <div class="mb-4">
                            <label for="name" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Digite seu usuário" autofocus />
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <label class="form-label" for="password">Senha</label>
                                <a href="#"><small>Esqueceu a senha?</small></a>
                            </div>
                            <div class="input-group">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="Digite sua senha" />
                                <span class="input-group-text cursor-pointer">
                                    <i class="bx bx-hide"></i>
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="bx bx-log-in me-2"></i>Entrar no Sistema
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-4">
                        <span style="color: #7f8c8d;">Novo por aqui?</span>
                        <a href="{{ route('cadastro') }}">Criar uma conta</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <script>
        window.APP_URL = "{{ config('app.url') }}" || window.location.origin;
    </script>
    
    <script src="/sneat-1.0.0/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/sneat-1.0.0/assets/vendor/libs/popper/popper.js"></script>
    <script src="/sneat-1.0.0/assets/vendor/js/bootstrap.js"></script>
    <script src="/sneat-1.0.0/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/sneat-1.0.0/assets/vendor/js/menu.js"></script>
    <script src="/sneat-1.0.0/assets/js/main.js"></script>

    <!-- Sweet Alert 2  -->
    <script src="/template/libs/sweetalert2/sweetalert2.all.min.js"></script>
    
    <!-- Personalized Js -->
    <script src="/js/generalFunctions.js"></script>
    <script src="/js/Auth/IuViLogin.js"></script>

    <link href="/template/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
