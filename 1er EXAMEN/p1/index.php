<php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pregunta1 pagina de banco</title>
    <link rel="stylesheet" href="styles_html.css">
    <script>
        function toggleContent(element) {
            const card = element.parentElement;
            const allCards = document.querySelectorAll('.card');

            allCards.forEach(c => {
                if (c !== card) {
                    c.classList.remove('show');
                }
            });

            card.classList.toggle('show');
        }
    </script>
</head>
<body>
    <img src="banco.jpg" alt="Imagen de fondo" class="background-image" />

    <div class="head">
        cuentas de banco
    </div>
    <h1>.ahorro, .credito y .dpf´s</h1>
    <div class="container">
        <div class="card">
            <div class="header" onclick="toggleContent(this)">
                .AHORRO <span class="preview">- Haz crecer tu dinero....</span>
            </div>
            <div>
                <br />
                <div class="section">
                    <div class="title2">
                        Descripción
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <div class="contenido2">
                        La Caja de Ahorro es un producto de captación que permite realizar depósitos y retiros de dinero y cuyos saldos devengan intereses diarios, capitalizados mensualmente. Está dirigido a personas naturales o jurídicas, de nacionalidad boliviana o extranjera con residencia legal en el país.
                    </div>
                </div>
                
                <div class="section">
                    <div class="title2">
                        Beneficios
                        <img src="2.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Accede a una tarjeta de débito según tu segmento: Banca Joven, Banca Activa o Banca Senior.</li>
                        <li>Pago de servicios con débito automático.</li>
                        <li>Acceso al Portal Transaccional.</li>
                        <li>Acceso a la App.</li>
                        <li>Las cajas de ahorro en bolivianos no pagan el ITF.</li>
                        <li>No se cobra mantenimiento mensual.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Características
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Retiros de efectivo en plataformas de cajas o cajeros automáticos con la tarjeta de débito BNB.</li>
                        <li>Posibilidad de débitos automáticos para pagar servicios básicos, cuotas de créditos, impuestos, entre otros.</li>
                        <li>Las Cajas de Ahorro pueden ser unipersonales (una firma) o colectivas (varias firmas).</li>
                        <li>Disponibles en bolivianos y dólares americanos.</li>
                        <li>Las Cajas de Ahorro del BNB tienen convertibilidad automática para depósitos y retiros en cualquier moneda.</li>
                        <li>Monto mínimo para apertura de acuerdo al tarifario.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Tasa de Interés para Personas Naturales
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>En bolivianos: 0 - 70.000 => 2% (sin condiciones).</li>
                        <li>En bolivianos: más de 70.000 => 0.01% (aplica para saldos promedios superiores a 70.000).</li>
                        <li>En dólares americanos: 0 - adelante => 0.01%.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Requisitos para Personas Naturales y Jurídicas
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Personas naturales: cédula de identidad u otro documento según el banco.</li>
                        <li>Personas jurídicas: documentos legales de constitución de la sociedad, registrados en FUNDEMPRESA.</li>
                        <li>Fotocopia legalizada del NIT (si corresponde).</li>
                    </ul>
                </div>
            </div>
        </div>
        

        <div class="card">
            <div class="header" onclick="toggleContent(this)">
                .CORRIENTE <span class="preview">- La Cuenta Corriente Única es un producto de captación y medio de pago, que recibe depósitos y permite retiros....</span>
            </div>
            <div>
                <br />
                <div class="section">
                    <div class="title2">
                        Descripción                            
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <div class="contenido2">
                        Este producto permite a los clientes ahorrar dinero y ganar intereses. Ofrece opciones flexibles para personas naturales y jurídicas. Está disponible para personas de nacionalidad boliviana y extranjeros con residencia legal.
                    </div>
                </div>
                
                <div class="section">
                    <div class="title2">
                        Beneficios                           
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Tarjeta de débito para acceder a tu cuenta.</li>
                        <li>Opciones para débito automático para el pago de servicios.</li>
                        <li>Acceso a la banca en línea y aplicación móvil.</li>
                        <li>No se cobra comisión por mantenimiento mensual.</li>
                    </ul>
                </div>
                
                <div class="section">
                    <div class="title2">                            
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                        Características
                    </div>
                    <ul class="contenido2">
                        <li>Permite depósitos y retiros mediante tarjeta de débito.</li>
                        <li>Posibilidad de hacer giros y transferencias.</li>
                        <li>Cuenta disponible en diferentes monedas, incluyendo bolivianos y dólares americanos.</li>
                        <li>Las cuentas de ahorro no devengan intereses.</li>
                    </ul>
                </div>
                
                <div class="section">
                    <div class="title2">                            
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                        Tasa de Interés para Personas Naturales
                    </div>
                    <ul class="contenido2">
                        <li>En bolivianos: tasa base del 0.01% para todos los depósitos.</li>
                        <li>En dólares americanos: tasa base del 0.01%.</li>
                    </ul>
                </div>
                
                <div class="section">
                    <div class="title2">
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                        Requisitos para Personas Naturales y Jurídicas
                    </div>
                    <ul class="contenido2">
                        <li>Personas naturales: cédula de identidad u otro documento según las políticas del banco.</li>
                        <li>Personas jurídicas: documentos legales de constitución de la sociedad, registrados ante la autoridad correspondiente.</li>
                        <li>Fotocopia legalizada del NIT, si corresponde.</li>
                    </ul>
                </div>
            </div>
        </div>
        

        <div class="card">
            <div class="header" onclick="toggleContent(this)">
                .DPF´S <span class="preview">- Son depósitos que luego de su constitución permanecen inmóviles por un plazo previamente pactado entre banco y el cliente....</span>
            </div>
            <div>
                <br />
                <div class="section">
                    <div class="title2">
                        Descripción
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <div class="contenido2">
                        Son depósitos que luego de su constitución permanecen inmóviles por un plazo previamente pactado entre el banco y el cliente. El plazo, la tasa de interés y el periodo de capitalización se establecen al momento de constitución del DPF.
                    </div>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Beneficios
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Los DPFs pueden ser cancelados en cualquier oficina o sucursal del banco.</li>
                        <li>Permiten ahorrar de forma segura, con intereses más altos que las cajas de ahorro.</li>
                        <li>Pueden garantizar operaciones crediticias en el banco.</li>
                        <li>Los DPFs constituidos en efectivo están exentos del Impuesto a las Transacciones Financieras (ITF).</li>
                        <li>Los DPFs en moneda nacional con plazo a partir de 31 días no gravan el Impuesto al Valor Agregado (IVA) sobre los intereses ganados.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Características
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>La emisión de DPFs es representada mediante anotación en cuenta (desmaterializados).</li>
                        <li>Se entrega una constancia impresa de constitución del DPF.</li>
                        <li>La constancia no es negociable ni transferible, y la titularidad se valida con documentos legales o cédula de identidad.</li>
                        <li>Los DPFs generan intereses según el plazo del depósito, pagaderos de manera periódica o al vencimiento.</li>
                        <li>DPFs con plazo hasta 30 días y mayor a 360 días no son redimibles.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Tasa de Interés para DPF en Moneda Nacional
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>0-30 días = 0.18%.</li>
                        <li>31-60 días = 0.40%.</li>
                        <li>61-90 días = 1.20%.</li>
                        <li>91-120 días = 1.50%.</li>
                        <li>121-150 días = 1.50%.</li>
                        <li>151-180 días = 1.50%.</li>
                    </ul>
                </div>
        
                <div class="section">
                    <div class="title2">
                        Requisitos para Personas Naturales y Jurídicas
                        <img src="1.jpg" alt="Imagen de ejemplo" class="imgb" />
                    </div>
                    <ul class="contenido2">
                        <li>Personas naturales: cédula de identidad u otro documento según las políticas del banco.</li>
                        <li>Personas jurídicas: documentos legales de constitución de la sociedad, registrados en FUNDEMPRESA.</li>
                        <li>Fotocopia legalizada del NIT, si corresponde.</li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
    <div class="footer">
        © 2024 Mi Sitio Web - Todos los derechos reservados INF-324
    </div>
</body>
</html>
