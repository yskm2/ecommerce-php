<main class="page-content">
    <form method="POST" action="<?= $BASE_URL ?>index.php?route=checkout-process">

        <div class="container checkout-layout">
            <!-- Información de facturación y envío -->
            <div class="informacion_facturacion">
                <h2>Información de facturación</h2>

                <div class="form-grid">
                    <div>
                        <label>Nombre(s)</label>
                        <input type="text" name="nombre" placeholder="Tu nombre"
                            value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Apellido(s)</label>
                        <input type="text" name="apellido" placeholder="Tus apellidos"
                            value="<?= htmlspecialchars($usuario['apellido'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>"
                            required>
                    </div>
                    <div>
                        <label>Teléfono</label>
                        <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>"
                            required>
                    </div>
                </div>

                <h2>Dirección de Envío</h2>

                <div class="form-row">
                    <label>Calle</label>
                    <input type="text" name="calle" placeholder="Ej. Av. Juárez"
                        value="<?= htmlspecialchars($direccion['calle'] ?? '') ?>" required>
                </div>

                <div class="form-grid">
                    <div>
                        <label>Número</label>
                        <input type="text" name="numero" placeholder="Ej. 123"
                            value="<?= htmlspecialchars($direccion['numero'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Colonia</label>
                        <input type="text" name="colonia" placeholder="Ej. Centro"
                            value="<?= htmlspecialchars($direccion['colonia'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" placeholder="Ej. Guadalajara"
                            value="<?= htmlspecialchars($direccion['ciudad'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Estado</label>
                        <input type="text" name="estado" placeholder="Ej. Jalisco"
                            value="<?= htmlspecialchars($direccion['estado'] ?? '') ?>" required>
                    </div>
                </div>

                <div class="form-grid">
                    <div>
                        <label>Código Postal</label>
                        <input type="text" name="codigo_postal" placeholder="Ej. 44100"
                            value="<?= htmlspecialchars($direccion['codigo_postal'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Referencias (opcional)</label>
                        <input type="text" name="referencias" placeholder="Ej. Frente al parque"
                            value="<?= htmlspecialchars($direccion['referencias'] ?? '') ?>">
                    </div>
                </div>

                <h2>Método de pago</h2>
                <select name="metodo_pago" required>
                    <option value="" disabled selected>Selecciona un método</option>
                    <option value="Tarjeta">Tarjeta de crédito / débito</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Transferencia">Transferencia bancaria</option>
                    <option value="Contra entrega">Pago contra entrega</option>
                </select>

                <div class="form-row">
                    <label>Notas adicionales (opcional)</label>
                    <textarea name="notas" placeholder="Instrucciones o comentarios"></textarea>
                </div>
            </div>

            <!-- Resumen de compra -->
            <div class="resumen-compra">
                <h2>Resumen de compra</h2>

                <div class="summary-calculation">
                    <div class="summary-row">
                        <p>Subtotal</p>
                        <span>$<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="summary-row">
                        <p>Envío</p>
                        <span>$<?= number_format($costo_envio, 2) ?></span>
                    </div>
                    <div class="summary-total">
                        <p>Total</p>
                        <span>$<?= number_format($total, 2) ?></span>
                    </div>
                </div>

                <button type="submit" class="btn-primary btn-checkout">
                    Realizar pedido
                </button>
            </div>
        </div>
    </form>
</main>