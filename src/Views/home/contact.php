<main class="page-content">
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Contáctanos</h1>
            <p>Estamos aquí para ayudarte. Déjanos un mensaje y te responderemos lo antes posible.</p>
        </div>
    </section>

    <section class="contact-info">
        <div class="container">
            <div class="contact-info-grid">
                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Ubicación</h3>
                    <p>Hermosillo, Sonora<br>México</p>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-phone"></i>
                    <h3>Teléfono</h3>
                    <p>010-020-0340</p>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <h3>Email</h3>
                    <p>info@ebrainrot.com</p>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <h2>Envíanos un mensaje</h2>
            <form class="contact-form" method="post" action="<?= $BASE_URL ?>index.php?route=contact-submit">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Tu nombre" required>
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
