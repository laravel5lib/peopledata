@extends('layouts.public')
@section('title')
    Política de privacidad y tratamiento de datos personales @parent
@endsection

@section('content')
    @php
        $church = 'LA IGLESIA CRISTIANA EL ENCUENTRO CON LA PALABRA DE DIOS';
    @endphp
    <div class="container">
        <h1>Aviso de privacidad</h1>
        <h3>POLÍTICA DE PRIVACIDAD Y PROTECCIÓN DE DATOS PERSONALES DE {{ $church }}</h3>
        <hr>
        <p>A continuación se presenta la Política de Privacidad y Protección de Datos Personales (en adelante la Política de Privacidad) aplicable a las
            personas que suministren sus datos personales (en adelante el “Titular”) a
            <strong>{{ $church }}</strong> (en adelante “LA IGLESIA”), los cuales se incluirán en las bases de datos de LA IGLESIA y serán sometidos a
            Tratamiento por parte de dicha entidad.
        </p>
        <hr>
        <h4>1. Responsable y Encargado del Tratamiento:</h4>
        <p>La entidad religiosa {{ $church }}¸ con domicilio principal en la ciudad de Medellín, la cual consta de Personería Jurídica Especial reconocida
            mediante la Resolución 0551 del 24 de marzo de 2011, inscrita en el Registro Público de las Entidades Religiosas y representada legalmente por
            el señor ALVARO FERNANDEZ SANCHEZ, identificado
            con cédula de ciudadanía No. 396840 de la ciudad de Bogotá D.C.</p>
        <hr>
        <h4>2. Alcance de la Política de Privacidad:</h4>
        <p>La presente Política de Privacidad se aplicará a todas las Bases de Datos y/o archivos que contengan Datos Personales que sean objeto de Tratamiento por parte de LA IGLESIA, en los eventos en los cuales se le considere como Responsable y/o Encargado del Tratamiento de Datos Personales de personas naturales, conforme a las disposiciones de la Ley Estatutaria 1581 de 2012, el Decreto 1377 de 2013 y demás normas que en adelante las modifiquen y/o adicionen.</p>
        <hr>
        <h4>3. Definiciones:</h4>
        <dl class="row">
            <dt class="col-sm-1">3.1.</dt>
            <dd class="col-sm-11">Dato Personal: Cualquier información vinculada o que pueda asociarse a una o varias personas naturales determinadas o determinables (en adelante “Datos Personales” o “Información Personal”).</dd>
            <dt class="col-sm-1">3.2.</dt>
            <dd class="col-sm-11">Base de Datos: Todo conjunto organizado de Datos Personales que sea objeto de Tratamiento.</dd>
            <dt class="col-sm-1">3.3.</dt>
            <dd class="col-sm-11">Tratamiento: Cualquier operación o conjunto de operaciones sobre Datos Personales, tales como su recolección, almacenamiento, uso, circulación o supresión.</dd>
            <dt class="col-sm-1">3.4.</dt>
            <dd class="col-sm-11">Encargado del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el Tratamiento de Datos Personales por cuenta del Responsable del Tratamiento.</dd>
            <dt class="col-sm-1">3.5.</dt>
            <dd class="col-sm-11">Responsable del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la Base de Datos y/o el Tratamiento de los datos.</dd>
            <dt class="col-sm-1">3.6.</dt>
            <dd class="col-sm-11">Titular: Persona natural cuyos Datos Personales sean objeto de Tratamiento.</dd>
            <dt class="col-sm-1">3.7.</dt>
            <dd class="col-sm-11">Transmisión de Datos: Tratamiento de Datos Personales que implica la comunicación de los mismos dentro o fuera del territorio de la República de Colombia cuando tenga por objeto la realización de un Tratamiento por el Encargado por cuenta del Responsable.</dd>
            <dt class="col-sm-1">3.8.</dt>
            <dd class="col-sm-11">Transferencia de Datos: La transferencia de datos tiene lugar cuando el Responsable y/o Encargado del Tratamiento de datos personales, ubicado en Colombia, envía la información o los datos personales a un receptor, que a su vez es Responsable del Tratamiento y se encuentra dentro o fuera del país.</dd>
            <dt class="col-sm-1">3.9.</dt>
            <dd class="col-sm-11">Datos Sensibles: Se entiende como datos sensibles aquellos que afecten la intimidad del titular o cuyo uso indebido pueda afectar la intimidad del Titular o la potencialidad de generar su discriminación.</dd>
            <dt class="col-sm-1">3.10.</dt>
            <dd class="col-sm-11">Datos Públicos: Aquellos datos que no sean semiprivados, privados o sensibles. Son considerados datos públicos, entre otros, los datos relativos al estado civil de la personas, a su profesión u oficio y a su calidad de comerciante o servidor público.</dd>
        </dl>
        <hr>
        <h4>4. Tratamiento de los Datos Personales por parte de LA IGLESIA:</h4>
        <p>LA IGLESIA, en el desarrollo de su objeto social y actividad económica, actúa como Responsable y/o Encargado del Tratamiento de datos personales que se encuentren en sus bases de datos. En consecuencia recolecta, almacena, utiliza, transmite, transfiere y suprime datos personales de personas naturales con las cuales tiene o ha tenido algún tipo de relación, cualquiera sea su naturaleza (civil, comercial y/o laboral); entre las cuales se incluye, pero sin limitarse a ellos, a afiliados, proveedores, contratistas, trabajadores, acreedores, y deudores.</p>
        <hr>
        <h4>5. Uso de la Política de Privacidad y Protección de la Información:</h4>
        <dl class="row">
            <dt class="col-sm-1">5.1.</dt>
            <dd class="col-sm-11">LA IGLESIA informa a todos los titulares de los Datos Personales que le sean suministrados, ya sea electrónica o manualmente, que el Tratamiento de los mismos se sujetará a la presente Política de Privacidad. En consecuencia, si un Titular no se encuentra de acuerdo con la presente Política de Privacidad, no podrá suministrar información alguna que deba registrarse en una de las Bases de Datos de LA IGLESIA.</dd>
            <dt class="col-sm-1">5.2.</dt>
            <dd class="col-sm-11">LA IGLESIA se encuentra comprometida con la seguridad y buen uso de los datos personales que le son suministrados y, en consecuencia, se obliga a darles los usos adecuados así como a mantener la confidencialidad requerida frente a los mismos de acuerdo a lo establecido en esta Política de Privacidad y en la legislación existente frente a la materia.</dd>
            <dt class="col-sm-1">5.3.</dt>
            <dd class="col-sm-11">La Información Personal podrá ser transferida a sus Entidades Religiosas Aliadas o Entidades relacionadas con {{ $church }}, así como a terceros y a autoridades judiciales o administrativas, sean personas naturales o jurídicas, colombianas o extranjeras, en aquellos eventos en los cuales la transferencia o transmisión de los datos sea necesaria para llevar a cabo los usos y actividades autorizadas por los Titulares conforme al objeto social de LA IGLESIA. En todos los eventos, dicha información se conservará bajo estricta confidencialidad y será sometida a un Tratamiento riguroso, respetando los derechos y las garantías de sus Titulares.</dd>
            <dt class="col-sm-1">5.4.</dt>
            <dd class="col-sm-11">De manera específica, pero sin limitarse a ello, LA IGLESIA podrá utilizar proveedores de servicios y procesadores de datos que trabajen en nombre de la misma. Dichos servicios podrán incluir servicios de alojamiento de sistemas y de mantenimiento, servicios de análisis, servicios de mensajería por email, servicios de entrega, gestión de transacciones de pago, y controles de solvencia y de dirección, entre otros. En consecuencia, los Titulares deben entender que al suministrarle información a LA IGLESIA, automáticamente le estarán concediendo a estos terceros autorización para acceder a su Información Personal, en la medida en que así lo precisen para prestar sus servicios.</dd>
            <dt class="col-sm-1">5.5.</dt>
            <dd class="col-sm-11">Es importante aclarar que LA IGLESIA ha emprendido y emprenderá todas las acciones necesarias para garantizar que tanto los proveedores de servicios como los procesadores que trabajan en nombre de la misma, así como las Entidades Religiosas Aliadas y demás terceros autorizados conforme a la presente Política de Privacidad, protejan, en todos los eventos, la confidencialidad de la Información Personal a su cargo.</dd>
            <dt class="col-sm-1">5.6.</dt>
            <dd class="col-sm-11">LA IGLESIA podrá recolectar información que se encuentre en el dominio público para complementar las bases de datos. A dicha información se le dará el mismo tratamiento señalado en la presente Política de Privacidad.</dd>
        </dl>
        <hr>
        <h4>6. Efectos de la Autorización:</h4>
        <p>Para todos los efectos, se entiende que la autorización expresa e informada otorgada por parte de los Titulares a favor de LA IGLESIA para el Tratamiento de sus Datos Personales, cualquiera que haya sido su medio (escrito, oral o por medio de conductas inequívocas), implica el entendimiento y la aceptación plena de todo el contenido de la presente Política de Privacidad.</p>
        <p>Es importante resaltar que si un Titular le suministra Información Personal a LA IGLESIA a través de sus sitios Web o por medio de cualquier canal adicional, físico o electrónico, dicho suministro de Información Personal es hecho de forma totalmente voluntaria y el Titular y/o sus Padres, según sea el caso, le concede(n) a la IGLESIA su autorización para que utilice dicha Información Personal conforme a las estipulaciones de la presente Política de Privacidad.</p>
        <hr>
        <h4>7. Información Personal Recolectada:</h4>
        <p>La Información Personal que LA IGLESIA puede recolectar y someter a Tratamiento incluye pero no está limitada a la siguiente:</p>
        <ul>
            <li>Nombre completo del Titular de la Información;</li>
            <li>Identificación;</li>
            <li>Fecha de nacimiento;</li>
            <li>Estado civil;</li>
            <li>Nacionalidad;</li>
            <li>Domicilio;</li>
            <li>Dirección de contacto;</li>
            <li>Teléfonos de contacto;</li>
            <li>Correo electrónico;</li>
            <li>Información Escolar;</li>
            <li>Información Profesional;</li>
            <li>Información Familiar;</li>
            <li>Información Socio-económica;</li>
        </ul>
        <hr>
        <h4>8. Finalidades y Usos de la Información:</h4>
        <p>A los datos personales que le sean suministrados a LA IGLESIA se les dará un Tratamiento conforme a las siguientes finalidades para el uso de la información, según le aplique a cada Titular:</p>
        <ol type="a">
            <li>Utilizar de la Información Personal por parte de LA IGLESIA y sus Entidades Religiosas Aliadas, con ocasión y para el desarrollo de su objeto social;</li>
            <li>Darle Tratamiento a la información en medios físicos y digitales, asegurando el correcto registro y la utilización de las páginas web de LA IGLESIA y sus aliadas;</li>
            <li>Incluir y darle Tratamiento a la información adquirida en virtud de la relación existente entre los Titulares y LA IGLESIA, cualquiera que sea su naturaleza jurídica (laboral, civil, comercial, etc);</li>
            <li>Realizar llamadas de seguimiento por la visita del Titular a LA IGLESIA;,</li>
            <li>Llevar a cabo acciones de consulta o actualización con áreas internas de la IGLESIA</li>
            <li>Contactar al Titular en el evento que se genere algún tipo de problema o inconveniente con la Información Personal;</li>
            <li>Contactar al Titular para ofrecerle nuestros servicios, mostrar publicidad o campañas de interés ofrecidos por LA IGLESIA;</li>
            <li>Contactar al Titular para que participe en las actividades promovidas por LA IGLESIA y/o sus Entidades Religiosas Aliadas;</li>
            <li>Enviar a los Titulares correos electrónicos como parte de una noticia o Newsletter. En cada e-mail enviado existe la posibilidad de solicitar no estar inscrito en esta lista de correos electrónicos para dejar de recibirlos.</li>
            <li>Prevenir y detectar el fraude, así como otras actividades ilegales;</li>
        </ol>
        <hr>
        <h4>9. Derechos de los titulares de la Información Personal:</h4>
        <p>Los Titulares de la Información Personal suministrada a LA IGLESIA tendrán los siguientes derechos:</p>
        <ol type="a">
            <li>El derecho a conocer, actualizar y rectificar su Información Personal gratuitamente;</li>
            <li>El derecho a solicitar prueba de la existencia de la autorización otorgada a LA IGLESIA;</li>
            <li>El derecho a ser informado respecto al uso que se le ha dado a su Información Personal;</li>
            <li>La facultad de revocar la autorización y solicitar la supresión del dato cuando no se haga un uso conforme a los usos y finalidades autorizados;</li>
            <li>El derecho a presentar consultas y reclamos referentes a la Información Personal.</li>
        </ol>
        <hr>
        <h4>10. Confidencialidad de la Información Personal:</h4>
        <ol type="a">
            <li>La Información Personal suministrada por los Titulares será utilizada únicamente por LA IGLESIA, sus Entidades Religiosas Aliadas y los terceros autorizados para tales fines, conforme a lo establecido tanto en la autorización como en la presente Política de Privacidad. La Información Personal no será destinada, en evento alguno, a propósitos distintos de aquellos para los cuales fue suministrada, razón por la cual LA IGLESIA procurará proteger la privacidad de la Información Personal y conservarla bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento, así como el respeto de los derechos de los Titulares de la misma.</li>
            <li>Si por cualquier circunstancia una autoridad competente solicita sea revelada la Información Personal, LA IGLESIA avisará a su Titular de tal situación, salvo cuando en virtud de la ley los datos sean solicitados para actuaciones judiciales o administrativas vinculadas a obligaciones fiscales, la investigación y persecución de delitos o actualización de sanciones administrativas, para realizar una acción en función del interés público, o hacer entrega de reportes tributarios al estado.</li>
            <li>La presente obligación de confidencialidad de la Información Personal tendrá un tiempo de duración ilimitado, es decir, que la obligación subsiste en el tiempo.</li>
        </ol>
        <hr>
        <h4>11. Tratamiento de Información Personal de Menores de Edad:</h4>
        <ol type="a">
            <li>En aplicación de lo establecido por el Artículo 7º de la Ley 1581 de 2012 y el artículo 12 del Decreto 1377 de 2013, LA IGLESIA procederá a efectuar el Tratamiento de la Información Personal, de niños, niñas y adolescentes, respetando el interés superior de los mismos y asegurando, en todos los casos, el respeto de sus derechos fundamentales y garantías mínimas.</li>
            <li>En todos los eventos en los que se requiera darle Tratamiento a la Información Personal de menores de edad, LA IGLESIA obtendrá la Autorización correspondiente por parte del representante legal del niño, niña o adolescente; previo ejercicio del menor de su derecho a ser escuchado, opinión que será valorada teniendo en cuenta la madurez, autonomía y capacidad del menor para entender el contenido de la autorización y del Tratamiento de sus Datos Personales.</li>
        </ol>
        <hr>
        <h4>12. Conectividad y Redes Sociales:</h4>
        <ol type="a">
            <li>Se deja expresa constancia que la página web de LA IGLESIA contiene conectores e hipervínculos a y con diferentes redes sociedades tales como pero sin limitarse a Facebook, Twitter, Instagram y Google. En este orden de ideas, si el Titular inicia sesión en una de las redes sociales durante la visita a los sitios web de la IGLESIA y/o de sus Entidades Religiosas Aliadas, la red social podrá añadir dicha información al perfil del Titular y, en consecuencia, cuando un Titular interactúa con alguna de las redes sociales y los servicios de LA IGLESIA, su Información Personal será transferida a la red social en cuestión.</li>
            <li>Teniendo en cuenta lo anterior, el Titular que no desee que se realice la trasferencia de su Información Personal a las diferentes redes sociales, deberá cerrar su sesión en la respectiva red social antes de ingresar a las páginas web de LA IGLESIA y demás Entidades Religiosas Aliadas.</li>
            <li>En consecuencia, no será responsabilidad de LA IGLESIA la recolección, transmisión y, en general, el Tratamiento que le sea proporcionado a la Información Personal del Titular en los eventos descritos en este capítulo. En esta medida, los Titulares que ingresen simultáneamente a las páginas web de LA IGLESIA y a sus perfiles en las diferentes redes sociales, se comprometen expresamente a conocer y a someterse a las políticas de privacidad de cada red social respectivas.</li>
        </ol>
        <hr>
        <h4>13. Procedimiento de Consulta, Rectificación y Reclamos: </h4>
        <ol type="a">
            <li>Consulta: Las consultas y solicitudes de los Titulares serán atendidas en un término máximo de diez (10) días hábiles, contados a partir de la fecha de recibo de las mismas. En caso de que no sea posible resolver la consulta dentro de este término, el Titular será informado de dicha situación en la dirección de notificación que haya incluido en la respectiva consulta, y el término de respuesta se podrá extender hasta por cinco (5) días hábiles adicionales. La respuesta a las consultas o reclamos que los Titulares presenten podrán ser entregadas por cualquier medio físico o electrónico. </li>
            <li>Rectificaciones y Reclamos: Cuando el Titular de la Información o sus causahabientes consideren que su información debe ser corregida, actualizada o suprimida, o cuando adviertan un presunto incumplimiento por parte de LA IGLESIA de sus deberes en materia de Protección de Datos Personales contenidos en la legislación aplicable y en la presente Política de Privacidad, podrán presentar un reclamo de la siguiente manera:
                <ul>
                    <li>Se deberá presentar solicitud escrita frente al requerimiento específico;</li>
                    <li>Si el reclamo resulta incompleto, LA IGLESIA requerirá al interesado dentro de los cinco (5) días siguientes a la recepción de la solicitud para que complete y subsanase su petición:
                        <ul>
                            <li>Si transcurren dos (2) meses desde la fecha del requerimiento sin que el solicitante haya dado respuesta, se entenderá desistida la pretensión.</li>
                            <li>Si quien recibe el reclamo no es competente para resolverlo, dará traslado a quien si lo sea para que resuelva en un término máximo de dos (2) días hábiles e informará de tal hecho al solicitante.</li>
                        </ul>
                    </li>
                    <li>Si el reclamo es recibido de manera completa o se ha completado posteriormente, deberá incluirse, dentro de los dos (2) días hábiles siguientes, una “leyenda” en la base de datos que indique “RECLAMO EN TRÁMITE”.</li>
                    <li>LA IGLESIA resolverá el reclamo en un término máximo de quince (15) días hábiles contados a partir del día siguiente de recibo del mismo. En caso de que no sea posible resolver la consulta dentro de este término, el Titular será informado de la demora, los motivos y la fecha de respuesta en la dirección de notificación que haya incluido en el respectivo reclamo. En todo caso, el término de respuesta no podrá superar de ocho (8) días hábiles siguientes al vencimiento del primer término. La respuesta a los reclamos que los Titulares presenten podrán ser efectuadas por cualquier medio físico o electrónico.</li>
                </ul>
            </li>
        </ol>

        <h4>14. Contacto:</h4>
        <p>En el evento de alguna duda o inquietud sobre la presente Política de Privacidad o el Tratamiento y uso de la Información Personal favor dirigir sus consultas, peticiones quejas o reclamos a:</p>
        <p>El correo electrónico: comunicaciones@elencuentrocondios.com;</p>
        <p>Solicitud por escrito a LA IGLESIA, en la dirección: Calle 9 Sur # 35-100, Loma de los Balsos, El Poblado, Medellín, Colombia;</p>
        <p>Llamando al número fijo 034 2686025;</p>
        <h4>15. Modificaciones de la Política de Privacidad:</h4>
        <p>LA IGLESIA se encuentra plenamente facultada para modificar la presente Política de Privacidad. Cualquier cambio será debidamente publicado en la página web www.elencuentrocondios.com y adicionalmente será informado ya sea por medios electrónicos o físicos a los Titulares de la Información Personal. El otorgamiento de la autorización, así como el registro en la Página Web será entendido como manifestación expresa de la aceptación de la presente Política de Privacidad.</p>
        <h4>16. Vigencia:</h4>
        <p>La presente Política de Privacidad se encuentra vigente a partir del día 22 de Marzo del año 2018.</p>

    </div>
@endsection

{{--<p><strong>1. Responsable y Encargado del Tratamiento:</strong></p>--}}
{{--<ul>--}}
{{--<li>La entidad religiosa--}}
{{--<strong>LA IGLESIA EL LUGAR DE SU PRESENCIA</strong>¸ con domicilio principal en la ciudad de Bogotá D.C., la cual consta de Personería Jurídica Especial reconocida mediante la Resolución 004 del 3 de enero de 2002 y modificada por la Resolución 0224 de 2011 del Ministerio del Interior, inscrita en el Registro Público de las Entidades Religiosas y representada legalmente por el señor WILLIAM ANDREW CORSON, identificado con cédula de ciudadanía No. 79.296.936 de la ciudad de Bogotá D.C.--}}
{{--</li>--}}
{{--</ul>--}}
{{--<p><strong> 2. </strong><strong>Alcance de la Política de Privacidad:</strong></p>--}}
{{--<ul>--}}
{{--<li>La presente Política de Privacidad se aplicará a todas las Bases de Datos y/o archivos que contengan Datos Personales que sean objeto de Tratamiento por parte de LA IGLESIA, en los eventos en los cuales se le considere como Responsable y/o Encargado del Tratamiento de Datos Personales de personas naturales, conforme a las disposiciones de la Ley Estatutaria 1581 de 2012, el Decreto 1377 de 2013 y demás normas que en adelante las modifiquen y/o adicionen.</li>--}}
{{--</ul>--}}
{{--<p><strong>3. </strong><strong>Definiciones:</strong></p>--}}
{{--<p>--}}
{{--<strong>3.1. </strong>Dato Personal: Cualquier información vinculada o que pueda asociarse a una o varias personas naturales determinadas o determinables (en adelante “Datos Personales” o “Información Personal”).--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.2. </strong>Base de Datos: Todo conjunto organizado de Datos Personales que sea objeto de Tratamiento.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.3. </strong>Tratamiento: Cualquier operación o conjunto de operaciones sobre Datos Personales, tales como su recolección, almacenamiento, uso, circulación o supresión.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.4. </strong>Encargado del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, realice el Tratamiento de Datos Personales por cuenta del Responsable del Tratamiento.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.5. </strong>Responsable del Tratamiento: Persona natural o jurídica, pública o privada, que por sí misma o en asocio con otros, decida sobre la Base de Datos y/o el Tratamiento de los datos.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.6. </strong>Titular: Persona natural cuyos Datos Personales sean objeto de Tratamiento.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.7. </strong>Transmisión de Datos: Tratamiento de Datos Personales que implica la comunicación de los mismos dentro o fuera del territorio de la República de Colombia cuando tenga por objeto la realización de un Tratamiento por el Encargado por cuenta del Responsable.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.8. </strong>Transferencia de Datos: La transferencia de datos tiene lugar cuando el Responsable y/o Encargado del Tratamiento de datos personales, ubicado en Colombia, envía la información o los datos personales a un receptor, que a su vez es Responsable del Tratamiento y se encuentra dentro o fuera del país.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.9. </strong>Datos Sensibles: Se entiende como datos sensibles aquellos que afecten la intimidad del titular o cuyo uso indebido pueda afectar la intimidad del Titular o la potencialidad de generar su discriminación.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>3.10. </strong>Datos Públicos: Aquellos datos que no sean semiprivados, privados o sensibles. Son considerados datos públicos, entre otros, los datos relativos al estado civil de la personas, a su profesión u oficio y a su calidad de comerciante o servidor público.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong> </strong><strong>4. </strong><strong>Tratamiento de los Datos Personales por parte de LA IGLESIA:</strong><strong> </strong>--}}
{{--</p>--}}
{{--<ul>--}}
{{--<li>LA IGLESIA, en el desarrollo de su objeto social y actividad económica, actúa como Responsable y/o Encargado del Tratamiento de datos personales que se encuentren en sus bases de datos. En consecuencia recolecta, almacena, utiliza, transmite, transfiere y suprime datos personales de personas naturales con las cuales tiene o ha tenido algún tipo de relación, cualquiera sea su naturaleza (civil, comercial y/o laboral); entre las cuales se incluye, pero sin limitarse a ellos, a afiliados, proveedores, contratistas, trabajadores, acreedores, y deudores.</li>--}}
{{--</ul>--}}
{{--<p>--}}
{{--<strong>5. </strong><strong>Uso de la Política de Privacidad y Protección de la Información:</strong>--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.1. </strong>LA IGLESIA informa a todos los titulares de los Datos Personales que le sean suministrados, ya sea electrónica o manualmente, que el Tratamiento de los mismos se sujetará a la presente Política de Privacidad. En consecuencia, si un Titular no se encuentra de acuerdo con la presente Política de Privacidad, no podrá suministrar información alguna que deba registrarse en una de las Bases de Datos de LA IGLESIA.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.2. </strong>LA IGLESIA se encuentra comprometida con la seguridad y buen uso de los datos personales que le son suministrados y, en consecuencia, se obliga a darles los usos adecuados así como a mantener la confidencialidad requerida frente a los mismos de acuerdo a lo establecido en esta Política de Privacidad y en la legislación existente frente a la materia.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.3. </strong>La Información Personal podrá ser transferida a sus Entidades Religiosas Aliadas o Entidades relacionadas con la iglesia El Lugar de Su Presencia, así como a terceros y a autoridades judiciales o administrativas, sean personas naturales o jurídicas, colombianas o extranjeras, en aquellos eventos en los cuales la transferencia o transmisión de los datos sea necesaria para llevar a cabo los usos y actividades autorizadas por los Titulares conforme al objeto social de LA IGLESIA. En todos los eventos, dicha información se conservará bajo estricta confidencialidad y será sometida a un Tratamiento riguroso, respetando los derechos y las garantías de sus Titulares.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.4. </strong>De manera específica, pero sin limitarse a ello, LA IGLESIA podrá utilizar proveedores de servicios y procesadores de datos que trabajen en nombre de la misma. Dichos servicios podrán incluir servicios de alojamiento de sistemas y de mantenimiento, servicios de análisis, servicios de mensajería por email, servicios de entrega, gestión de transacciones de pago, y controles de solvencia y de dirección, entre otros. En consecuencia, los Titulares deben entender que al suministrarle información a LA IGLESIA, automáticamente le estarán concediendo a estos terceros autorización para acceder a su Información Personal, en la medida en que así lo precisen para prestar sus servicios.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.5. </strong> Es importante aclarar que LA IGLESIA ha emprendido y emprenderá todas las acciones necesarias para garantizar que tanto los proveedores de servicios como los procesadores que trabajan en nombre de la misma, así como las Entidades Religiosas Aliadas y demás terceros autorizados conforme a la presente Política de Privacidad, protejan, en todos los eventos, la confidencialidad de la Información Personal a su cargo.--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>5.6. </strong>LA IGLESIA podrá recolectar información que se encuentre en el dominio público para complementar las bases de datos. A dicha información se le dará el mismo tratamiento señalado en la presente Política de Privacidad.--}}
{{--</p>--}}
{{--<p><strong>6. </strong><strong>Efectos de la Autorización:</strong></p>--}}
{{--<ul>--}}
{{--<li>Para todos los efectos, se entiende que la autorización expresa e informada otorgada por parte de los Titulares a favor de LA IGLESIA para el Tratamiento de sus Datos Personales, cualquiera que haya sido su medio (escrito, oral o por medio de conductas inequívocas), implica el entendimiento y la aceptación plena de todo el contenido de la presente Política de Privacidad.</li>--}}
{{--</ul>--}}
{{--<ul>--}}
{{--<li>Es importante resaltar que si un Titular le suministra Información Personal a LA IGLESIA a través de sus sitios Web o por medio de cualquier canal adicional, físico o electrónico, dicho suministro de Información Personal es hecho de forma totalmente voluntaria y el Titular y/o sus Padres, según sea el caso, le concede(n) a la IGLESIA su autorización para que utilice dicha Información Personal conforme a las estipulaciones de la presente Política de Privacidad.</li>--}}
{{--</ul>--}}
{{--<p></p>--}}
{{--<p><strong>7. </strong><strong>Información Personal Recolectada:</strong></p>--}}
{{--<ul>--}}
{{--<li>La Información Personal que LA IGLESIA puede recolectar y someter a Tratamiento incluye pero no está limitada a la siguiente:</li>--}}
{{--</ul>--}}
{{--<ul>--}}
{{--<li>--}}
{{--<ul>--}}
{{--<li>Nombre completo del Titular de la Información;</li>--}}
{{--<li>Identificación</li>--}}
{{--<li>Fecha de nacimiento;</li>--}}
{{--<li>Estado civil;</li>--}}
{{--<li>Nacionalidad;</li>--}}
{{--<li>Domicilio;</li>--}}
{{--<li>Dirección de contacto;</li>--}}
{{--<li>Teléfonos de contacto ;</li>--}}
{{--<li>Correo electrónico;</li>--}}
{{--<li>Información Escolar;</li>--}}
{{--<li>Información Profesional;</li>--}}
{{--<li>Información Familiar;</li>--}}
{{--<li>Información Socio-económica;</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<p></p>--}}
{{--<p><strong>8. </strong><strong>Finalidades y Usos de la Información:</strong><strong> </strong>--}}
{{--</p>--}}
{{--<ul>--}}
{{--<li>A los datos personales que le sean suministrados a LA IGLESIA se les dará un Tratamiento conforme a las siguientes finalidades para el uso de la información, según le aplique a cada Titular:</li>--}}
{{--</ul>--}}
{{--<p>a) Utilizar de la Información Personal por parte de LA IGLESIA y sus Entidades Religiosas Aliadas, con ocasión y para el desarrollo de su objeto social;</p>--}}
{{--<p>b) Darle Tratamiento a la información en medios físicos y digitales, asegurando el correcto registro y la utilización de las páginas web de LA IGLESIA y sus aliadas;</p>--}}
{{--<p>c) Incluir y darle Tratamiento a la información adquirida en virtud de la relación existente entre los Titulares y LA IGLESIA, cualquiera que sea su naturaleza jurídica (laboral, civil, comercial, etc);</p>--}}
{{--<p>d) Realizar llamadas de seguimiento por la visita del Titular a LA IGLESIA;,</p>--}}
{{--<p>e) Llevar a cabo acciones de consulta o actualización con áreas internas de la IGLESIA</p>--}}
{{--<p>f) Contactar al Titular en el evento que se genere algún tipo de problema o inconveniente con la Información Personal;</p>--}}
{{--<p>g) Contactar al Titular para ofrecerle nuestros servicios, mostrar publicidad o campañas de interés ofrecidos por LA IGLESIA;</p>--}}
{{--<p>h) Contactar al Titular para que participe en las actividades promovidas por LA IGLESIA y/o sus Entidades Religiosas Aliadas;</p>--}}
{{--<p>i) Enviar a los Titulares correos electrónicos como parte de una noticia o--}}
{{--<em>Newsletter</em>. En cada e-mail enviado existe la posibilidad de solicitar no estar inscrito en esta lista de correos electrónicos para dejar de recibirlos. Para esto el Titular deberá realizar la solicitud escrita en el formulario que se encuentra en el siguiente link:--}}
{{--<a href="http://goo.gl/forms/6ePw6dN5ZI" style="margin: 0px; padding: 0px; border: 0px; vertical-align: baseline; color: rgb(0, 116, 189); text-decoration: none; font-family: 'Lucida Grande', 'Lucida Sans Unicode', sans-serif; font-size: 13.008px; line-height: 20.0063px;" target="_blank">http://goo.gl/forms/6ePw6dN5ZI</a> o escribir al correo protecciondedatos @ supresencia .com.--}}
{{--</p>--}}
{{--<p>j) Prevenir y detectar el fraude, así como otras actividades ilegales;</p>--}}
{{--<p><strong> </strong></p>--}}
{{--<p><strong>9. </strong><strong>Derechos de los titulares de la Información Personal:</strong>--}}
{{--</p>--}}
{{--<ul>--}}
{{--<li>Los Titulares de la Información Personal suministrada a LA IGLESIA tendrán los siguientes derechos:</li>--}}
{{--</ul>--}}
{{--<p></p>--}}
{{--<p>a) El derecho a conocer, actualizar y rectificar su Información Personal gratuitamente;</p>--}}
{{--<p>b) El derecho a solicitar prueba de la existencia de la autorización otorgada a LA IGLESIA;</p>--}}
{{--<p>c) El derecho a ser informado respecto al uso que se le ha dado a su Información Personal;</p>--}}
{{--<p>d) La facultad de revocar la autorización y solicitar la supresión del dato cuando no se haga un uso conforme a los usos y finalidades autorizados;</p>--}}
{{--<p>e) El derecho a presentar consultas y reclamos referentes a la Información Personal.</p>--}}
{{--<p></p>--}}
{{--<p><strong>10. </strong><strong>Confidencialidad de la Información Personal:</strong></p>--}}
{{--<p> a) La Información Personal suministrada por los Titulares será utilizada únicamente por LA IGLESIA, sus Entidades Religiosas Aliadas y los terceros autorizados para tales fines, conforme a lo establecido tanto en la autorización como en la presente Política de Privacidad. La Información Personal no será destinada, en evento alguno, a propósitos distintos de aquellos para los cuales fue suministrada, razón por la cual LA IGLESIA procurará proteger la privacidad de la Información Personal y conservarla bajo las condiciones de seguridad necesarias para impedir su adulteración, pérdida, consulta, uso o acceso no autorizado o fraudulento, así como el respeto de los derechos de los Titulares de la misma.</p>--}}
{{--<p>b) Si por cualquier circunstancia una autoridad competente solicita sea revelada la Información Personal, LA IGLESIA avisará a su Titular de tal situación, salvo cuando en virtud de la ley los datos sean solicitados para actuaciones judiciales o administrativas vinculadas a obligaciones fiscales, la investigación y persecución de delitos o actualización de sanciones administrativas, para realizar una acción en función del interés público, o hacer entrega de reportes tributarios al estado.</p>--}}
{{--<p>c) La presente obligación de confidencialidad de la Información Personal tendrá un tiempo de duración ilimitado, es decir, que la obligación subsiste en el tiempo.</p>--}}
{{--<p></p>--}}
{{--<p><strong>11. </strong><strong>Tratamiento de Información Personal de Menores de Edad:</strong>--}}
{{--</p>--}}
{{--<p></p>--}}
{{--<p>--}}
{{--<strong>11.1 </strong>En aplicación de lo establecido por el Artículo 7º de la Ley 1581 de 2012 y el artículo 12 del Decreto 1377 de 2013, LA IGLESIA procederá a efectuar el Tratamiento de la Información Personal, de niños, niñas y adolescentes, respetando el interés superior de los mismos y asegurando, en todos los casos, el respeto de sus derechos fundamentales y garantías mínimas.--}}
{{--</p>--}}
{{--<p></p>--}}
{{--<p>--}}
{{--<strong>11.2 </strong>En todos los eventos en los que se requiera darle Tratamiento a la Información Personal de menores de edad, LA IGLESIA obtendrá la Autorización correspondiente por parte del representante legal del niño, niña o adolescente; previo ejercicio del menor de su derecho a ser escuchado, opinión que será valorada teniendo en cuenta la madurez, autonomía y capacidad del menor para entender el contenido de la autorización y del Tratamiento de sus Datos Personales.--}}
{{--</p>--}}
{{--<p><strong>12. </strong><strong>Conectividad y Redes Sociales:</strong></p>--}}
{{--<p><strong> </strong></p>--}}
{{--<p>--}}
{{--<strong>12.1 </strong>Se deja expresa constancia que la página web de LA IGLESIA contiene conectores e hipervínculos a y con diferentes redes sociedades tales como pero sin limitarse a Facebook, Twitter, Instagram y Google. En este orden de ideas, si el Titular inicia sesión en una de las redes sociales durante la visita a los sitios web de la IGLESIA y/o de sus Entidades Religiosas Aliadas, la red social podrá añadir dicha información al perfil del Titular y, en consecuencia, cuando un Titular interactúa con alguna de las redes sociales y los servicios de LA IGLESIA, su Información Personal será transferida a la red social en cuestión.--}}
{{--</p>--}}
{{--<p></p>--}}
{{--<p>--}}
{{--<strong>12.2 </strong>Teniendo en cuenta lo anterior, el Titular que no desee que se realice la trasferencia de su Información Personal a las diferentes redes sociales, deberá cerrar su sesión en la respectiva red social antes de ingresar a las páginas web de LA IGLESIA y demás Entidades Religiosas Aliadas.--}}
{{--</p>--}}
{{--<p></p>--}}
{{--<p>--}}
{{--<strong>12.3 </strong>En consecuencia, no será responsabilidad de LA IGLESIA la recolección, transmisión y, en general, el Tratamiento que le sea proporcionado a la Información Personal del Titular en los eventos descritos en este capítulo. En esta medida, los Titulares que ingresen simultáneamente a las páginas web de LA IGLESIA y a sus perfiles en las diferentes redes sociales, se comprometen expresamente a conocer y a someterse a las políticas de privacidad de cada red social respectivas.--}}
{{--</p>--}}
{{--<p></p>--}}
{{--<p><strong>13. </strong><strong>Procedimiento de Consulta, Rectificación y Reclamos:</strong>--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>13.1 </strong><strong>Consulta</strong><strong>:</strong> Las consultas y solicitudes de los Titulares serán atendidas en un término máximo de diez (10) días hábiles, contados a partir de la fecha de recibo de las mismas. En caso de que no sea posible resolver la consulta dentro de este término, el Titular será informado de dicha situación en la dirección de notificación que haya incluido en la respectiva consulta, y el término de respuesta se podrá extender hasta por cinco (5) días hábiles adicionales. La respuesta a las consultas o reclamos que los Titulares presenten podrán ser entregadas por cualquier medio físico o electrónico.<strong> </strong>--}}
{{--</p>--}}
{{--<p>--}}
{{--<strong>13.2 </strong><strong>Rectificaciones y Reclamos: </strong>Cuando el Titular de la Información o sus causahabientes consideren que su información debe ser corregida, actualizada o suprimida, o cuando adviertan un presunto incumplimiento por parte de LA IGLESIA de sus deberes en materia de Protección de Datos Personales contenidos en la legislación aplicable y en la presente Política de Privacidad, podrán presentar un reclamo de la siguiente manera:--}}
{{--</p>--}}
{{--<ul>--}}
{{--<li>--}}
{{--<ul>--}}
{{--<li>--}}
{{--<ul>--}}
{{--<li>Se deberá presentar solicitud escrita frente al requerimiento específico;</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<ul>--}}
{{--<li>--}}
{{--<ul>--}}
{{--<li>--}}
{{--<ul>--}}
{{--<li>Si el reclamo resulta incompleto, LA IGLESIA requerirá al interesado dentro de los cinco (5) días siguientes a la recepción de la solicitud para que complete y subsanase su petición:--}}
{{--<ul>--}}
{{--<li>Si transcurren dos (2) meses desde la fecha del requerimiento sin que el solicitante haya dado respuesta, se entenderá desistida la pretensión.</li>--}}
{{--<li>Si quien recibe el reclamo no es competente para resolverlo, dará traslado a quien si lo sea para que resuelva en un término máximo de dos (2) días hábiles e informará de tal hecho al solicitante.</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--<li>Si el reclamo es recibido de manera completa o se ha completado posteriormente, deberá incluirse, dentro de los dos (2) días hábiles siguientes, una “leyenda” en la base de datos que indique “RECLAMO EN TRÁMITE”.<strong> </strong>--}}
{{--</li>--}}
{{--<li>LA IGLESIA resolverá el reclamo en un término máximo de quince (15) días hábiles contados a partir del día siguiente de recibo del mismo. En caso de que no sea posible resolver la consulta dentro de este término, el Titular será informado de la demora, los motivos y la fecha de respuesta en la dirección de notificación que haya incluido en el respectivo reclamo. En todo caso, el término de respuesta no podrá superar de ocho (8) días hábiles siguientes al vencimiento del primer término. La respuesta a los reclamos que los Titulares presenten podrán ser efectuadas por cualquier medio físico o electrónico.<strong> </strong>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--</ul>--}}
{{--<p><strong>14. </strong><strong>Contacto:</strong></p>--}}
{{--<p>En el evento de alguna duda o inquietud sobre la presente Política de Privacidad o el Tratamiento y uso de la Información Personal favor dirigir sus consultas, peticiones quejas o reclamos a:</p>--}}
{{--<ol>--}}
{{--<li>El correo electrónico:--}}
{{--<a href="mailto:protecciondedatos@supresencia.com">protecciondedatos@supresencia.com</a>;--}}
{{--</li>--}}
{{--<li>Solicitud por escrito al área de Tecnología de--}}
{{--<strong>LA IGLESIA</strong>, en la dirección: Carera 49 No.94-39.--}}
{{--</li>--}}
{{--<li>Llamando a nuestro call-center al número 7460202;</li>--}}
{{--</ol>--}}
{{--<p>--}}
{{--<strong> </strong><strong>15. </strong><strong>Modificaciones de la Política de Privacidad:</strong>--}}
{{--</p>--}}
{{--<ul>--}}
{{--<li>LA IGLESIA se encuentra plenamente facultada para modificar la presente Política de Privacidad. Cualquier cambio será debidamente publicado en la página web--}}
{{--<a href="http://www.supresencia.com">www.supresencia.com</a> y adicionalmente será informado ya sea por medios electrónicos o físicos a los Titulares de la Información Personal. El otorgamiento de la autorización, así como el registro en la Página Web será entendido como manifestación expresa de la aceptación de la presente Política de Privacidad.--}}
{{--</li>--}}
{{--</ul>--}}
{{--<p><strong>16. </strong><strong>Vigencia:</strong></p>--}}
{{--<ul>--}}
{{--<li>La presente Política de Privacidad se encuentra vigente a partir del día 1 de Junio del año 2013.</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</article>--}}

{{--</section>--}}
{{--</div>--}}
{{--</section>--}}


{{--</div>--}}
{{--</div>--}}

{{--<footer class="footer container">--}}
{{--<div class="region region-footer">--}}
{{--<section id="block-block-33" class="block block-block logo-footer clearfix">--}}


{{--<i></i>--}}
{{--</section>--}}
{{--<section id="block-menu-menu-consulta-frecuentes" class="block block-menu consultas clearfix">--}}

{{--<h2 class="block-title">Consultas Frecuentes</h2>--}}

{{--<ul class="menu nav">--}}
{{--<li class="first leaf">--}}
{{--<a href="/calificaciones-berea" id="calificaciones">Calificaciones Su Presencia Berea</a></li>--}}
{{--<li class="leaf"><a href="/r07">Descarga el R07</a></li>--}}
{{--<li class="leaf">--}}
{{--<a href="http://supresencia.com/hoja-de-vida-prematrimonial">Descarga el formato de Prematrimonial</a>--}}
{{--</li>--}}
{{--<li class="leaf"><a href="/grupos-de-conexion">Grupos de conexión</a></li>--}}
{{--<li class="leaf"><a href="/horarios-de-clase" id="horarios-berea">Horarios de clases</a></li>--}}
{{--<li class="last leaf"><a href="http://supresencia.com/matriculas-berea">Matrículas Berea 2018</a></li>--}}
{{--</ul>--}}
{{--</section>--}}
{{--<section id="block-block-34" class="block block-block mapa clearfix">--}}

{{--<h2 class="block-title">Mapa</h2>--}}

{{--<p><a href="/nuestras-reuniones/#mapas" class="js-mapa"><i class="map"></i>Mapa</a></p>--}}
{{--<p style="font-size: initial;color: #fff;">Calle 95 Bis No. 50-36</p>--}}
{{--</section>--}}
{{--<section id="block-menu-menu-footer-links" class="block block-menu footer-links clearfix">--}}

{{--<h2 class="block-title">Footer links</h2>--}}

{{--<ul class="menu nav">--}}
{{--<li class="first leaf active-trail active">--}}
{{--<a href="/aviso-de-privacidad" class="active-trail active">Aviso de privacidad</a></li>--}}
{{--<li class="leaf"><a href="/contacto" class="fa fa-envelope-o">Contacto</a></li>--}}
{{--<li class="last leaf">--}}
{{--<a href="/" title="Teléfono Call Center: (571) 7460202" class="telefono">Teléfono Call Center: (571) 7460202</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</section>--}}
{{--<section id="block-block-4" class="block block-block clearfix">--}}


{{--<!-- begin olark code -->--}}
{{--<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/--}}
{{--window.olark || (function (c) {--}}
{{--var f = window, d = document, l = f.location.protocol == "https:" ? "https:" : "http:", z = c.name, r = "load";--}}
{{--var nt = function () {--}}
{{--f[z] = function () {--}}
{{--(a.s = a.s || []).push(arguments)--}}
{{--};--}}
{{--var a = f[z]._ = {}, q = c.methods.length;--}}
{{--while (q--) {--}}
{{--(function (n) {--}}
{{--f[z][n] = function () {--}}
{{--f[z]("call", n, arguments)--}}
{{--}--}}
{{--})(c.methods[q])--}}
{{--}--}}
{{--a.l = c.loader;--}}
{{--a.i = nt;--}}
{{--a.p = {--}}
{{--0: +new Date--}}
{{--};--}}
{{--a.P = function (u) {--}}
{{--a.p[u] = new Date - a.p[0]--}}
{{--};--}}

{{--function s () {--}}
{{--a.P(r);--}}
{{--f[z](r)--}}
{{--}--}}

{{--f.addEventListener ? f.addEventListener(r, s, false) : f.attachEvent("on" + r, s);--}}
{{--var ld = function () {--}}
{{--function p (hd) {--}}
{{--hd = "head";--}}
{{--return ["<", hd, "></", hd, "><", i, ' onl' + 'oad="var d=', g, ";d.getElementsByTagName('head')[0].", j, "(d.", h, "('script')).", k, "='", l, "//", a.l, "'", '"', "></", i, ">"].join("")--}}
{{--}--}}

{{--var i = "body", m = d[i];--}}
{{--if (!m) {--}}
{{--return setTimeout(ld, 100)--}}
{{--}--}}
{{--a.P(1);--}}
{{--var j = "appendChild", h = "createElement", k = "src", n = d[h]("div"), v = n[j](d[h](z)), b = d[h]("iframe"), g = "document", e = "domain", o;--}}
{{--n.style.display = "none";--}}
{{--m.insertBefore(n, m.firstChild).id = z;--}}
{{--b.frameBorder = "0";--}}
{{--b.id = z + "-loader";--}}
{{--if (/MSIE[ ]+6/.test(navigator.userAgent)) {--}}
{{--b.src = "javascript:false"--}}
{{--}--}}
{{--b.allowTransparency = "true";--}}
{{--v[j](b);--}}
{{--try {--}}
{{--b.contentWindow[g].open()--}}
{{--} catch (w) {--}}
{{--c[e] = d[e];--}}
{{--o = "javascript:var d=" + g + ".open();d.domain='" + d.domain + "';";--}}
{{--b[k] = o + "void(0);"--}}
{{--}--}}
{{--try {--}}
{{--var t = b.contentWindow[g];--}}
{{--t.write(p());--}}
{{--t.close()--}}
{{--} catch (x) {--}}
{{--b[k] = o + 'd.write("' + p().replace(/"/g, String.fromCharCode(92) + '"') + '");d.close();'--}}
{{--}--}}
{{--a.P(2)--}}
{{--};--}}
{{--ld()--}}
{{--};--}}
{{--nt()--}}
{{--})({--}}
{{--loader: "static.olark.com/jsclient/loader0.js", name: "olark", methods: ["configure", "extend", "declare", "identify"]--}}
{{--});--}}
{{--/* custom configuration goes here (www.olark.com/documentation) */--}}
{{--olark.identify('1676-105-10-8702');--}}
{{--/*]]>*/</script>--}}
{{--<noscript>--}}
{{--<a href="https://www.olark.com/site/1676-105-10-8702/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by--}}
{{--<a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a>--}}
{{--</noscript>--}}
{{--<!-- end olark code -->--}}
{{--</section>--}}
{{--<section id="block-block-35" class="block block-block clearfix">--}}


{{--<span id="top-link-block" class="affix hidden">--}}
{{--<a href="#top" title="Tope de la página">--}}
{{--<i class="fa fa-chevron-up"></i>--}}
{{--</a>--}}