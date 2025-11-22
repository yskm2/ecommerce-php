<?php
/**
 * Vista: Checkout - Finalizar Compra
 * Variables esperadas:
 * - $BASE_URL (string): URL base de la aplicación
 * - $usuario (array): Datos del usuario para prellenar formulario
 * - $carrito (array): Items del carrito
 * - $total (float): Total de la compra
 */
$usuario = $usuario ?? [];
$carrito = $carrito ?? [];
$total = $total ?? 0;
?>
<main class="page-content" role="main">
    <div class="container">
        <header>
            <h1 class="page-title" id="checkout-heading">Finalizar Compra</h1>
        </header>
        
        <form method="POST" action="<?= $BASE_URL ?>index.php?route=checkout-process" aria-labelledby="checkout-heading">
            <div class="checkout-layout">
                <!-- Información de facturación y envío -->
                <section class="billing-info" aria-labelledby="billing-heading">
                    <h2 id="billing-heading">Información de facturación</h2>

                <fieldset class="form-grid">
                    <legend class="sr-only">Información personal</legend>
                    <div>
                        <label for="nombre">Nombre(s)</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre"
                            value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>" aria-required="true" required>
                    </div>
                    <div>
                        <label for="apellido">Apellido(s)</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Tus apellidos"
                            value="<?= htmlspecialchars($usuario['apellido'] ?? '') ?>" aria-required="true" required>
                    </div>
                </fieldset>

                <fieldset class="form-grid">
                    <legend class="sr-only">Información de contacto</legend>
                    <div>
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>"
                            aria-required="true" required>
                    </div>
                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>"
                            aria-required="true" required>
                    </div>
                </fieldset>

                <h3 id="shipping-heading">Dirección de Envío</h3>

                <fieldset>
                    <legend class="sr-only">Dirección completa de envío</legend>
                    <div class="form-row">
                        <label for="calle">Calle</label>
                        <input type="text" id="calle" name="calle" placeholder="Ej. Av. Juárez"
                            value="<?= htmlspecialchars($direccion['calle'] ?? '') ?>" aria-required="true" required>
                    </div>

                    <div class="form-grid">
                        <div>
                            <label for="numero">Número</label>
                            <input type="text" id="numero" name="numero" placeholder="Ej. 123"
                                value="<?= htmlspecialchars($direccion['numero'] ?? '') ?>" aria-required="true" required>
                        </div>
                        <div>
                            <label for="colonia">Colonia</label>
                            <input type="text" id="colonia" name="colonia" placeholder="Ej. Centro"
                                value="<?= htmlspecialchars($direccion['colonia'] ?? '') ?>" aria-required="true" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div>
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Ej. Guadalajara"
                                value="<?= htmlspecialchars($direccion['ciudad'] ?? '') ?>" aria-required="true" required>
                        </div>
                        <div>
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" name="estado" placeholder="Ej. Jalisco"
                                value="<?= htmlspecialchars($direccion['estado'] ?? '') ?>" aria-required="true" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div>
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" id="codigo_postal" name="codigo_postal" placeholder="Ej. 44100"
                                value="<?= htmlspecialchars($direccion['codigo_postal'] ?? '') ?>" aria-required="true" required>
                        </div>
                        <div>
                            <label for="referencias">Referencias (opcional)</label>
                            <input type="text" id="referencias" name="referencias" placeholder="Ej. Frente al parque"
                                value="<?= htmlspecialchars($direccion['referencias'] ?? '') ?>" aria-label="Referencias opcionales para encontrar la dirección">
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend id="payment-heading">Método de pago</legend>
                    <label for="metodo_pago">Selecciona un método de pago</label>
                    <select id="metodo_pago" name="metodo_pago" aria-required="true" required>
                        <option value="" disabled selected>Selecciona un método</option>
                        <option value="Tarjeta">Tarjeta de crédito / débito</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Transferencia">Transferencia bancaria</option>
                        <option value="Contra entrega">Pago contra entrega</option>
                    </select>
                </fieldset>

                <div class="form-row">
                    <label for="notas">Notas adicionales (opcional)</label>
                    <textarea id="notas" name="notas" placeholder="Instrucciones o comentarios" aria-label="Notas o instrucciones adicionales para el pedido"></textarea>
                </div>
            </section>

            <!-- Resumen de compra -->
            <aside class="resumen-compra" aria-labelledby="summary-heading">
                <h2 id="summary-heading">Resumen de compra</h2>

                <div class="summary-calculation">
                    <div class="summary-row" aria-label="Subtotal: $<?= number_format($subtotal, 2) ?>">
                        <p>Subtotal</p>
                        <span>$<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="summary-row" aria-label="Envío: $<?= number_format($costo_envio, 2) ?>">
                        <p>Envío</p>
                        <span>$<?= number_format($costo_envio, 2) ?></span>
                    </div>
                    <div class="summary-total" aria-label="Total a pagar: $<?= number_format($total, 2) ?>">
                        <p>Total</p>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                </div>

                <button type="submit" class="btn-primary btn-checkout" aria-label="Realizar pedido y proceder al pago">
                    Realizar pedido
                </button>
            </aside>
        </div>
    </form>
</main>