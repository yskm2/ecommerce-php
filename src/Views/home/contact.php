<main class="page-content" role="main">
    <section class="page-header" aria-labelledby="contact-heading">
        <div class="container">
            <header>
                <h1 class="page-title" id="contact-heading">Contáctanos</h1>
                <p>Estamos aquí para ayudarte. Déjanos un mensaje y te responderemos lo antes posible.</p>
            </header>
        </div>
    </section>

    <section class="contact-info" aria-labelledby="contact-info-heading">
        <div class="container">
            <h2 id="contact-info-heading" class="sr-only">Información de contacto</h2>
            <div class="contact-info-grid" role="list">
                <article class="contact-info-item" role="listitem">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <h3>Ubicación</h3>
                    <address>
                        Hermosillo, Sonora<br>
                        México
                    </address>
                </article>
                <article class="contact-info-item" role="listitem">
                    <i class="fas fa-phone" aria-hidden="true"></i>
                    <h3>Teléfono</h3>
                    <p><a href="tel:0100200340" aria-label="Llamar al 010-020-0340">010-020-0340</a></p>
                </article>
                <article class="contact-info-item" role="listitem">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:info@ebrainrot.com" aria-label="Enviar correo a info@ebrainrot.com">info@ebrainrot.com</a></p>
                </article>
            </div>
        </div>
    </section>

    <section class="contact-section" aria-labelledby="contact-form-heading">
        <div class="container">
            <h2 id="contact-form-heading">Envíanos un mensaje</h2>
            <form class="contact-form" method="post" action="<?= $BASE_URL ?>index.php?route=contact-submit" aria-label="Formulario de contacto">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Tu nombre" aria-required="true" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="tu@email.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" name="subject" placeholder="¿En qué podemos ayudarte?" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" placeholder="Escribe tu mensaje aquí..." rows="8" required></textarea>
                </div>
                <div class="form-submit-row">
                    <button type="submit" class="btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </section>
</main>
