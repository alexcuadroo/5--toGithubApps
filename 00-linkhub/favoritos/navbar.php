<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /auth');
    exit();
}
?>

<head>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 28px;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.1);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-details {
            display: flex;
            align-items: center;
            position: relative;
        }

        .user-details h2 {
            color: #ffffff;
            margin-right: 10px;
            font-size: 18px;
        }

        .avatar-container {
            position: relative;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;

            &:hover {
                border: 2px solid #ffffff;
                cursor: pointer;
            }
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 44px;
            right: 0;
            background-color: #003303d4;
            border: 1px solid #003303;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s ease;
            z-index: 10;
        }

        .dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #FFF;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
            color: #333;
        }

        .avatar-container:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<nav class="navbar">
    <div class="logo">
        <a href="../" style="text-decoration: none;">
            <img src="../assets/linkhub.webp" alt="Logo" width="28px">
        </a>
    </div>
    <div class="user-info">
        <div class="user-details">
            <h2><?php echo $_SESSION['user']['name']; ?></h2>
            <div class="avatar-container">
                <img class="avatar" src="<?php echo $_SESSION['user']['picture']; ?>" alt="Avatar">
                <div class="dropdown-menu">
                    <a href="../../">Menú Principal</a>
                    <a href="logout.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>
</nav>