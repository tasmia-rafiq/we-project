<?php 
include 'header.php';
include 'dbconnect.php';
?>
    <!-- Top Banner Section -->
    <section id="shop-header" class="about-header">
        <h2 class="fadeInRight animate">Let's Connect</h2>
        <p class="fadeInTop animate"><strong>Leave a Message, We love to hear from you!</strong></p>
    </section>

    <!-- Contact Section -->
    <section id="contact-details" class="section-pad1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our shop locations or contact us today</h2>
            <h3>Shop</h3>

            <div>
                <li>
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>Nazimabad, karachi - Sindh, Pakistan</p>
                </li>
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <p>contact@gmail.com</p>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>(021)-7775678</p>
                </li>
                <li>
                    <i class="fa-solid fa-clock"></i>
                    <p>Monday to Saturday: 9:00 a.m. to 16:00 p.m.</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7235.969794228943!2d67.10902877239764!3d24.93258441506319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb338bf22becb0f%3A0xd5e50842c5c4867b!2sNED%20University%20Of%20Engineering%20%26%20Technology%2C%20Karachi%2C%20Karachi%20City%2C%20Sindh%2C%20Pakistan!5e0!3m2!1sen!2s!4v1657644473843!5m2!1sen!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="form-details">
        <form action="" method="POST">
            <span>LEAVE A MESSAGE HERE</span>
            <h2>We love to hear from you!</h2>
            <input type="text" placeholder="Your Name" name="cname">
            <input type="email" placeholder="Email" name="cemail">
            <textarea name="cmessage" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal" type="submit" name="submit">Submit</button>
            <p id="success"></p>
        </form>

        <div class="people">
            <div>
                <img src="img/people/me.png" alt="">
                <p><span>Tasmia Rafiq</span> Junior Software Engineer <br> Phone: (021)-2233901 <br>Email: tasmia4300364@cloud.neduet.edu.pk
                </p>
            </div>
        </div>
    </section>

    <?php 
    if(isset($_POST['submit'])){
        $cname = $_POST["cname"];
        $cemail = $_POST["cemail"];
        $cmessage = $_POST["cmessage"];
        $sql = "INSERT INTO `contact` (`name`, `email`, `message`) VALUES ('$cname', '$cemail', '$cmessage')";
        $sqlResult = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if($sqlResult){
            echo'
                <script>
                    alert("Your message as been sent Successfully.");
                    
                </script>';
        }
        else{
            echo'
                <script>
                    alert("Error occurred while sending your message.");
                </script>';
        }
    }
    ?>

    <!-- NewsLetter -->
    <section id="newsletter" class="section-pad1 section-marg1">
        <div class="newstext">
            <h4>Sign Up for Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>

        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign up</button>
        </div>
    </section>

    <?php include 'footer.php' ?>
