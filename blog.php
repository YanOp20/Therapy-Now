<?php session_start(); ?>

<?php include_once "head.php" ?>

<body>
    <?php include_once "header.php" ?>

    <style>
        .blog {
            /* background: #B85042; */
            display: flex;
            height: 100%;
            max-height: 100%;
            /* overflow: hidden; */
            width: 100%;
            background-color: white;
            color: rgb(36, 36, 36);
            font-family: source-serif-pro, Georgia, Cambria, "Times New Roman", Times, serif;
        }

        /* section */
        section {
            /* background: #A7BEAE; */
            flex-basis: 67%;
            width: 100%;
            /* border: solid 5px pink; */
            flex-grow: 1;
        }

        .blog section div {
            /* border: solid 1px yellowgreen; */
            margin: 2vh 4.5vw 2vw 7.5vw;
        }

        section div img {
            width: 100%;
            height: 100%;
        }

        section div.sub img {
            margin-left: 0.5vw;
            margin-bottom: 1vw;
            /* max-width: 12vw; */
            /* max-height: 100%;  */
            width: 80%;
            height: auto;
            /* float: right;  */
        }



























        #form-container {
            display: none;
            /* hide the form container by default */
            margin: 0;
        }

        .fdf {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .blogForm {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 500px;
        }

        .blogForm input[type="text"],
        .blogForm input[type="file"],
        .blogForm textarea {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .blogForm input[type="text"],
        .blogForm input[type="file"] {
            width: 100%;
        }

        .blogForm textarea {
            resize: vertical;
            min-height: 100px;
        }

        .blogForm .submit {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
            font-size: 16px;
        }

        .blogForm .submit:hover {
            background-color: #3e8e41;
        }

        .error-text {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .create-form-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .create-form-btn:hover {
            background-color: #3e8e41;
        }

        nav div button.cancel-form-btn {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-left: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        nav div button.cancel-form-btn:hover {
            background-color: #da190b;
        }

















        .sub {
            /* border: solid 2px red; */
            /* background-color: back; */
            /* height: 400px;
        width: 400px; */
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: auto auto;
            grid-template-areas:
                "h1 img"
                "p img";
            align-items: center;
        }

        section a .sub img {
            grid-area: img;
        }

        section a .sub h1 {
            grid-area: h1;
        }

        section a .sub p {
            grid-area: p;
        }







        /* nav */
        nav {
            /* border: solid 5px yellowgreen; */
            display: flex;
            flex-direction: column;
            flex-basis: 33%;
            overflow: scroll;
            /* background: #E7E8D1; */
        }

        nav div {
            /* display: flex; */
            /* border: solid 1px yellowgreen; */
            margin: 4vh 7.5vw 1vw 4.5vw;
            font-size: 0.75em;
            font-weight: 600;
        }

        nav div h1 {
            font-size: 1em;
        }

        nav div img {
            margin-right: 0.5vw;
            max-width: 7vw;
            max-height: 14vh;
            width: 100%;
            height: 100%;
            float: left;
        }


        #form-container {
            display: none;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            width: 400px;
        }

        .fdf {
            margin: 0;
            padding: 0;
        }

        .fdf form {
            display: flex;
            flex-direction: column;
        }

        form div {
            margin: auto;
        }

        .blog .see {
            /* height: calc(); */
            overflow: hidden;
        }



        @media (max-width: 850px) {

            /* section div.sub img {
        width: 50%;
      } */
            nav {
                display: none;

            }
        }

        #seemore {
            font-weight: 800;
            font-size: 1.5em;
            border: none;
            background-color: white;
            font-weight: 500;
            color: cadetblue;
            margin: 2%;
        }

        #seemore:hover {
            cursor: pointer;
        }

        /* *{border: 1px red solid;} */

        .blog a {
            color: black;
        }

        .blog a:hover {
            text-decoration: underline;
        }
    </style> 

    <div class="blog">
        <?php
        $id = "";
        if (isset($_GET['id'])) {
            // include_once "config.php";
            $id = $_GET['id'];
            $sql = "SELECT * FROM blog WHERE id=$id";
            $output = "";
            $query = mysqli_query($conn, $sql);
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    if ($row['img']) {
                        $output .= '<div class="detail">
                                                <img src="php\images\\' . $row['img'] . '">
                                                <h1>' . $row['title'] . '</h1>
                                                <p> ' . $row['text'] . '</p>                    
                                                </div>';
                    } else {
 
                        $output .= '<div class="detail">
                                    <h1>' . $row['title'] . '</h1>
                                    <p> ' . $row['text'] . '</p>
                                </div>';
                    }
                }
            }
            $output .= '<div><a href="blog.php"  >see more</a></div> ';
            echo '<section>';
            echo nl2br($output);
            echo '</section>';
        } else {
            echo '<section class="see">';
            include_once "php/get-blog.php";
            echo '</section>';
        }
        ?>

<nav>

<?php
include_once "php/config.php";
if(isset($_SESSION['unique_id'])){
            $sql =mysqli_query($conn, "SELECT * FROM therapist WHERE unique_id = {$_SESSION['unique_id']}");
        }
        if (isset($_SESSION['unique_id']) and mysqli_num_rows($sql) > 0) {
            ?>
            <!-- <div class="content" style="  display: flex;  align-items: center;"> -->
    
                <div><button class="create-form-btn" id="create-form-btn">Create a post</button></div>
                <div id="form-container" style="margin: 0;">
                <div class="fdf">

                    <form class="blogForm" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-text"></div>
                        <input type="text" name="_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                        <input name="title" class="m" type="text" placeholder="Title" required>
                        <input class="m" type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                        <textarea class="m" name="text" rows="4" cols="50" placeholder="write a text..." required></textarea>
                        <input class="submit m" type="submit" name="submit" value="post">
                    </form>
                </div>
            </div>
            <?php
        }
            
    else{
        ?>
        <div style="display: none;"><button class="create-form-btn" id="create-form-btn">Create a post</button></div>

<?php 
    } 





        
            include_once "php/get-blog-nav.php";  ?>
        </nav>
    </div>
    <button id="seemore" style="display:none"> See more</button>
    <?php include_once "footer.php" ?>
    <script src="javascript/blog.js"></script>


    <script>
        const cfbtn = document.getElementById("create-form-btn");
        const formContainer = document.getElementById("form-container");
        // console.log(cfbtn);
        cfbtn.addEventListener('click', () => {
            if (formContainer.style.display === "none") {
                formContainer.style.display = "block";
                cfbtn.innerHTML = "Cancel"
                cfbtn.classList.add("cancel-form-btn");
                // console.log(cfbtn);
            } else {
                formContainer.style.display = "none";
                cfbtn.innerHTML = "Create a post"
                cfbtn.classList.remove("cancel-form-btn");
                // console.log(cfbtn);
            }
        });


        const seemore = document.getElementById('seemore');
        const see = document.querySelector(".see");
        const nav = document.querySelector("nav");
        const section = document.querySelector("section");
        const d = document.querySelectorAll(".see div");
        // console.log(section)
        // console.log(window.getComputedStyle(section).height)
        let sum = 0;
        // for (let i = 0; i < (sum < 1750 ? d.length : 10); i++) {
        for (let i = 0; i < (d.length < 10 ? d.length : 10); i++) {
            let style = window.getComputedStyle(d[i]);
            let height = style.height;
            let num = parseFloat(height);
            sum += num;
        }
        const sectionDiv = document.querySelector("section div");
        let style = window.getComputedStyle(sectionDiv);
        let height = style.height;
        let num = parseFloat(height);

        // console.log(nav.style.height = num + 'px')
        // nav.style.minHeight = 200 + 'px';

        if (see !== null) {
            // element.style.color = 'red';
            see.style.height = `${sum}px`;
            nav.style.height = `${sum + 75}px`;
        } else {
            if (document.querySelector("section .detail").offsetHeight < 750) {

                nav.style.height = `${750}px`;
            } else {
                nav.style.height = `${(document.querySelector("section .detail").offsetHeight) + 200}px`;
            }

        }
        console.log(nav.offsetHeight)
        // console.log( section)
        // console.log( nav)
        // let sstyle = window.getComputedStyle(section);
        // let shight = style.height;
        // nav.style.height = shight;
        // const sh = section.offsetHeight;
        // nav.style.maxHeight = `${200}px`;p



        // console.log("section height", sh)






        const s = document.querySelector("section");
        const dg = s.querySelectorAll(".sub");
        let totalHeight = 0;
        for (let i = 0; i < dg.length; i++) {
            const height = dg[i].offsetHeight;
            totalHeight += height;
        }
        const sectionHeight = s.offsetHeight;
        if (totalHeight > sectionHeight) {
            s.style.height = (sectionHeight + 75) + "px";
        }






































        if (see !== null) {
            var offsetHeight = see.offsetHeight;
            var scrollHeight = see.scrollHeight;

            if (scrollHeight > offsetHeight) {
                seemore.style.display = "block";
            } else {
                seemore.style.display = "none";
                nav.style.hight = "auto";
            }
            var currentHeight = getComputedStyle(see).height;

            function seeMore() {
                see.style.height = "auto";
                nav.style.height = "auto";

                seemore.style.display = "none";
                // see.style.height = "100%";
            }
            seemore.addEventListener('click', seeMore);
            // nav.style.hight = see.style.height;
        }





        // let container = document.querySelector('section');
        // let di = container.querySelectorAll('div');
        // // let container2 = document.querySelector('nav');
        // let div2 = nav.querySelectorAll('a');

        // for (let i = 0; i < di.length; i++) {
        //     let color = getRandomColor();
        //     let color2 = getRandomColor();
        //     di[i].style.backgroundColor = color;
        //     div2[i].style.backgroundColor = color2;
        // }

        // function getRandomColor() {
        //     let letters = '0123456789ABCDEF';
        //     let color = '#';
        //     for (let i = 0; i < 6; i++) {
        //         color += letters[Math.floor(Math.random() * 16)];
        //     }
        //     return color;
        // }

        // window.onresize = seeMore;
    </script>
</body>

</html