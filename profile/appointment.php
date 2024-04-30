<style>
    .payment p .p {
        color: black;
    }

    .payment p,
    .process-payment p {
        font-weight: 500;
        font-size: medium;
    }

    .process-payment .img-log {
        display: flex;
        /* justify-content: center; */
        gap: 2em;
        padding-left: 1em;
    }

    .process-payment div {
        /* border:solid 1px pink; */
    }

    .process-payment .paymet-description .bank-show div p {
        font-size: 0.75em;

    }

    .process-payment .payment-code-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.3em;

    }

    .process-payment .paymet-description .bank-show div.sss {
        display: flex;
        width: 100%;
        margin-left: 1em;
        border: solid green 0.1px;
        align-items: center;
        width: max-content;
        padding: 5px;
    }

    .process-payment .paymet-description .bank-show p.small {
        font-weight: 300;
        font-size: 0.5em;
    }

    .process-payment .paymet-description .bank-show {
        display: flex;
        padding-left: 1em;
        align-items: center;
    }

    .process-payment .paymet-description {
        display: flex;
        flex-direction: column;
        gap: 0.3em;
    }

    .process-payment .paymet-description>* {
        /* border:solid 2px green; */
        background-color: rgba(179, 255, 179, 0.3);
        border-radius: 23px;
        padding: 1em;
        /* max-width: max-content; */
    }

    .payment {
        margin: 2em;
        min-width: 300;
        /* border: solid; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1em;
    }

    .process-payment {
        /* border:solid; */
        display: flex;
        flex-direction: column;
        gap: 1em
    }

    .process-payment .paymet-description .bank-show img {
        width: 30px;
        height: 30px;
    }

    .process-payment .img-log img {
        width: 40px;
        height: 40px;
    }

    .p-c {
        color: green;
    }
</style>
<div class="right appointment">
    <form class="app-form" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="form">
            <h1>Booking Appointment</h1>
            <div class="error-text"></div>
            <div>
                <label for="">Whats lead you to consider therapy today</label>
                <select name="symptom" id="" required>
                    <option value="">select...</option>
                    <option value="I've been felling depressed">I've been felling depressed</option>
                    <option value="I feel anxious or overwhelmed">I feel anxious or overwhelmed</option>
                    <option value="My mood is interfering with my job/school performance">My mood is interfering
                        with my job/school performance</option>
                    <option value="I struggle with building or maintaining relationships">I struggle with building
                        or maintaining relationships</option>
                    <option value="I can't find purpose and meaning in my life">I can't find purpose and meaning in
                        my life</option>
                    <option value="I am grieving">I am grieving</option>
                    <option value="I have experienced trauma">I have experienced trauma</option>
                    <option value="I need to talk through a specific challenge">I need to talk through a specific
                        challenge</option>
                    <option value="I want to gain self confidence">I want to gain self confidence</option>
                    <option value="I want to improve myself but i don't know where to start">I want to improve
                        myself but i don't know where to start</option>
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
        </div>

        <div class="payment">
            <p>Date:<span class="p">39/23/2021</span></p>
            <p>Time: <span class="p">3:29 - 2:29</span></p>
            <p>200 ETB</p>
            <button>process to pay</button>
        </div>

        <div class="process-payment">
            <div class="img-log">
                <img src="img/awash.webp" alt="">
                <img src="img/cbe.webp" alt="">
                <img src="img/telebirr.webp" alt="">
                <img src="img/boa.webp" alt="">
            </div>

            <div class="paymet-description">
                <p>Copy the payment code below and go to "one of mobile banking Application"</p>
                <p>select "utility"</p>
                <div class="bank-show">
                    <p>select</p>
                    <div class="sss">
                        <img src="img/logo.png" alt="">
                        <div>
                            <p>Therapy-now</p>
                            <p class="small">pay for therapy</p>
                        </div>
                    </div>
                </div>
                <p>Fill in / payment code</p>
                <p>select "confirm your payment"</p>
                <p>you therapy appointment was appointemented</p>
            </div>
            <div class="payment-code-container">
                <p class="p-c">payment code</p>
                <p class="payment-code">2222222222</p>
            </div>
        </div>
    </form>

</div>
<script src="javascript/appointment.js"></script>