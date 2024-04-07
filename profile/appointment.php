    <style>
        .doctor .right .appointment {
            width: 50vw;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        form {
            /* border: 1px solid black; */
            border-radius: 16px;
            padding: 5em;
            padding-top: 2em;
            display: flex;
            flex-direction: column;
            justify-content: space-around;

            gap: 1em;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            font-weight: 450;
            font-size: large;
            margin-bottom: 0.23em;
            /* font-style:italic; */
        }

        input,
        textarea,
        select,
        option {
            display: block;
            margin-top: 0.5em;
            width: 100%;
            height: 40px;
            /* background-color: #fff; */
            padding-right: 0.3em;
            font-size: 1em;
            font-weight: thing;
        }

        input[type="submit"] {
            background-color: green;
            padding: 0.5em;
            color: white;
            font-weight: 500;
            font-size: 1em;
            /* font-weight: bold; */
        }

        .appointment-success {
            font-size: medium;
            color: green;
        }

        .error-text {
            color: red;
        }
    </style>

    <div class="right">
        <div class="appointment">

            <form class="app-form" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <h1>Booking Appointment</h1>
                <div class="error-text"></div>
                <div>
                    <label for="">Whats lead you to consider therapy today</label>
                    <select name="symptom" id="" required>
                        <option value="">select...</option>
                        <option value="I've been felling depressed">I've been felling depressed</option>
                        <option value="I feel anxious or overwhelmed">I feel anxious or overwhelmed</option>
                        <option value="My mood is interfering with my job/school performance">My mood is interfering with my job/school performance</option>
                        <option value="I struggle with building or maintaining relationships">I struggle with building or maintaining relationships</option>
                        <option value="I can't find purpose and meaning in my life">I can't find purpose and meaning in my life</option>
                        <option value="I am grieving">I am grieving</option>
                        <option value="I have experienced trauma">I have experienced trauma</option>
                        <option value="I need to talk through a specific challenge">I need to talk through a specific challenge</option>
                        <option value="I want to gain self confidence">I want to gain self confidence</option>
                        <option value="I want to improve myself but i don't know where to start">I want to improve myself but i don't know where to start</option>
                        <option value="Just Exploring">Just Exploring</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>

                    <input type="date" id="date" min="<?= date('Y-m-d') ?>" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <!-- <input type="time" id="time" name="time" min="02:00" max="05:00"> -->

                    <input type="time" id="time" name="time" required>
                </div>
                <input class="submit" type="submit" name="submit" value="Book Appointment">
                <div class="appointment-success"></div>
            </form>
        </div>
    </div>
    <script src="javascript/appointment.js"></script>