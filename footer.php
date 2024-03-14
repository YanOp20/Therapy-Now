<style>
    .social-icons {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .social-icons li {
        display: inline-block;
        margin-right: 10px;
    }


    .social-icons a {
        color:bisque;
        text-decoration: line-through;
    }


    .social-icons a:hover {
        color: #1a044d;
    }

    .copy {
        color: #999999;
        /* font-size: small; */
        text-align: left;
    }


    footer {
        /* box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
            0 32px 64px -48px rgba(0, 0, 0, 0.5);


        background: #fff; */
        background-color: #083836;
        color: #E2D1F9;
        font-size: small;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        align-items: top;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        border-bottom-left-radius: 16px;
        border-bottom-right-radius: 16px;
        min-height: 34hv;
    }

    .four {
        flex-basis: 100%;

    }

    .copy {
        margin-top: 5px;
        text-align: left;
    }

    img {
        width: 50px;
        height: 50px;
    }

    .one {
        flex-grow: 0.1;
    }

    footer div a h3 {
        font-size: xx-small;
        font-style: italic
    }

    footer div a {
        display: flex;
        width: 100%;
        text-align: center;
        align-items: center;
        color: #E2D1F9;
        font-weight: 500;
    }

    footer div a:hover {
        color: #3A6B35;
        /* background-color: #E2D1F9; */
    }
</style>
<footer>
    <div>
        <a href="index.php">
            <img src="img/logo.png" alt="" style="width: 50px;">
            <h3>Therapy Now</h3>
        </a>
    </div>
    <div class="one">
        <!-- <h3><a href="index.php">Home</a></h3> -->
        <!-- <h3><a href="blog.php">Blog</a></h3> -->
        <!-- <h3><a href="users.php">chat</a></h3>
        <h3><a href="profile.php">Dr.</a></h3> -->
        <h3><a href="about.php">About Us</a></h3>
        <h3><a href="Terms&Conditions.php">Terms and Conditions</a></h3>

    </div>
    <div class="two">
        <h3><a href="contact.php
        ">Contact Us</a></h3>
        <p><i class="fas fa-phone"></i> +1 251 567 890</p>
        <p><i class="fas fa-envelope"></i> info@onlinetherapy.com</p>
    </div>
    <div class="three">
        <h3>Follow Us</h3>
        <ul class="social-icons">
            <li><a target="_blank" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
            <li><a target="_blank" href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
            <li><a target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            <li><a target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
    </div>
    <div class="four">
        <p class="copy">© 2023 Online Therapy. All rights reserved.</p>
    </div>
</footer>