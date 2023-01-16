<?php

//ha rányomtam a submitre a formnál
if (isset($_POST["submit-subscr"])) {

    //ha minden mező be van állítva
    if (
        isset($_POST["subscr-email"]) && !empty($_POST["subscr-email"])
    ) {

        $_SESSION["subscription"] = $_POST["subscr-email"];
        header("Location: success.php");
        ob_end_flush();
    }
}
?>
<!-- newsletter subscribe sáv -->
<section id="newsletter-subscribe" class="greenbg">
    <div class="maxw dfsb">
        <h2 class="section-paddinglow">Iratkozz fel hírlevelünkre!</h2>
        <p clas="section-paddinglow">Újdonságok, hírek, vadonatúj termékek első kézből!</p>
        <form method="POST" class="subscribe-newsletter-form dfc">
            <input type="email" name="subscr-email" placeholder="pelda@peldamail.hu">
            <input type="submit" name="submit-subscr" value="FELIRATKOZÁS">
        </form>
    </div>
</section>