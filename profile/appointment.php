        <div class="right appointment">
            <form class="app-form" action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
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
            </form>
    </div>
    <script src="javascript/appointment.js"></script>