<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/sidebar.css">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="cog-outline"></ion-icon>
                        </span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <select class="title">Manage order:

                            <option class=''>View </option>
                            <option class=''>Pending order</option>
                            <option class='mo3'>Rejected order</option>
                        </select></label>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <select class="title">Manage Product:

                            <option className='mp1'
                                value='http://localhost/Hoops/Admin%20panel/project/productshow.php#'>View all product
                            </option>
                            <option className='mp2'
                                value='http://localhost/Hoops/Admin%20panel/project/uploadproduct.php'>Add new product
                            </option>
                        </select>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbox-outline"></ion-icon>
                        </span>
                        <select class="title">Manage User

                            <option className='mu1' value='http://localhost/Hoops/Admin%20panel/project/manageuser.php'>
                                View all user</option>
                            <!-- <option className='mu2' value=''>delete user</option> -->
                        </select>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-circle-outline"></ion-icon>
                        </span>
                        <select class="title">Manage category:

                            <option className='mc1'
                                value='http://localhost/Hoops/Admin%20panel/project/createcategory.php'>Manage category
                            </option>
                            <!-- <option className='mc2'>create new category</option> -->
                        </select>
                    </a>
                </li>
                <!-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Setting</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li> -->
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>

        </div>


        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <!-- <ion-icon name="menu-outline"></ion-icon> -->

                </div>
                <!-- <div class="search">
                    <label>
                        <input type="text" placeholder="search Here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>

                </div> -->
                <!-- userImage -->
                <div class="user">
                    <!-- <img src="https://th.bing.com/th?id=OIP.ixZ69lPCOZ3ZO5UqSHQGIAHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" alt="img"> -->
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
    // add hover effect in selected class using DOM
    let list = document.querySelectorAll('.navigation li');

    function activeLink() {
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('mouseover', activeLink));
    </script>
</body>

</html>