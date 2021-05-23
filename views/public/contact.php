<?php ob_start();?>

<div id="contact_container" class="container" >
    <section id="contact">
        <div class="outer-container">
            <h1 id="titreContact">Contactez-nous !</h1>
            <div class="telEmail">
                <div class="item contact-box phone">
                    <div class="text1">
                    <span class="logoContact"><i class="fas fa-mobile-alt"></i></span>
                        <a id="tel" href="tel:+33624035012">+33 6 24 03 50 12</a>
                    </div>
                </div>
                <div class="item contact-box email">
                    <span class="logoContact"><i class="fas fa-at"></i></span>
                    <div class="text2"><a id="emailContact" href="mailto:nathaliebendavidweb@gmail.com">nathaliebendavidweb@gmail.com</a></div>
                </div>      
            </div>
            <iframe id="iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.534525049279!2d2.4152355510228194!3d48.84801677918476!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6728424b715a3%3A0x57e198db63e65e9e!2s21%20Avenue%20Joffre%2C%2094160%20Saint-Mand%C3%A9!5e0!3m2!1sfr!2sfr!4v1616023790325!5m2!1sfr!2sfr" width="500" height="280" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>