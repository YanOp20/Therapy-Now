<?php session_start(); ?>
<?php include_once "head.php" ?>
<style>
.home {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2em;
    justify-content: flex-start;
}

.home h1 {
    padding: 50px;
    font-size: 2em;
    width: 100%;
    text-align: center;
    color: black;
    font-weight: 500;
    background-color: rgba(190, 247, 206, .2);
    font-style: italic;
    font-family: monospace;
    align-self: baseline;
}

.home,
.home a {
    color: darkslategrey;
}

.home a:hover {
    text-decoration: underline;
}

.home a span {
    /* font-size: small; */
    color: blueviolet;
}

.home img {
    width: auto;
    height: 70vh;
    margin-bottom: 3em;
    object-fit: cover;

}

.home .link {
    padding: 1em;
    background-color: rgba(0, 247, 0, .2);
    border: solid 2px;
    border-radius: 50%;
    font-weight: 700;
    margin-bottom: 50px;
}

.home .dis {
    font-size: 1.8em;
    /* border: solid 2px red; */
}

/* *{border: solid red 1px;} */
.home div {
    width: 75%;
    /* height: 100vh; */
    height: auto;
    display: flex;
    /* border: solid 1px red; */
    gap: 2em;
    justify-content: space-around;
    align-items: center;
}

.home div p {
    /* flex-basis: 60%; */
    text-align: center;
    padding: 2em;
    background: rgba(190, 247, 206, .2);
    border-radius: 50%;
    width: 100%;
}

.home div img {
    /* flex-basis: 40%; */
    width: 40%;
    height: auto;
    border-radius: 7%;

}

.home div.vh {
    height: 70vh;
}

@media screen and (max-width: 768px) {
    .home div {
        height: auto;
        display: flex;
        flex-direction: column;
    }

    .home div * {
        margin: 0;
        padding: 0;
    }

    .home .dis {
        font-size: 1em;
    }
}
</style>

<body>
    <?php include_once "header.php" ?>
    <div class="home">
        <h1>Therapy that helps you find your inner peace</h1>
        <div>
            <a href="blog.php?id=34">
                <p>What is Therapy? <br>psychotherapy, a treatment that involves talking with a trained professional to
                    improve mental health and well-being, and covers various topics related to finding and receiving
                    therapy... <span>Read more</span></p>
            </a>
        </div>
        <div class="vh">
            <p class="dis">Taking the first step towards seeking help can be daunting,</p>
            <img src="img/seeking.jpeg" alt="">
        </div>
        <div class="vh">
            <p class="dis">but remember that you are not alone.</p>
            <img src="img/unity-and-love-partnership-as-ropes-shaped-as-a-heart-in-a-group-of-diverse-strings-connected-together-shaped-as-a-support-symbol-expressing-2BHFYP6.jpg"
                alt="">
        </div>
        <div class="vh">
            <p class="dis"> Online therapy provides a safe and convenient way to connect with a trained professional
                from the comfort of your own home.</p>
            <img src="img/appshomestudy-scaled.jpg" alt="">
        </div>
        <div class="vh">
            <p class="dis"> online therapy, you have the power to take control of your mental health and well-being.</p>
            <img src="img/nature-walking-good-for-you-health-benefits-osmotherley-hiker.jpg" alt="">
        </div>
        <div class="vh">
            <p class="dis"> You deserve to live a happy and fulfilling life, and online therapy can help you get there.
            </p>
            <img src="img/person-standing-top-mountain-with-hand-up-back-view-city-sunset_535168-843.jpg" alt="">
        </div>
        <div class="vh">
            <p class="dis"> So take that first step, and know that you are making a positive change for yourself. You
                are worth it.</p>
            <img src="img/zb5ev8ml.png" alt="">
        </div>
        <a class="link" href="signup.php">Get Started</a>
    </div>

    <?php include_once "footer.php" ?>
</body>

</html>