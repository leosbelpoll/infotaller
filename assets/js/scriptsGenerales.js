// Matomo code
var _paq = window._paq || [];
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
var u="//analisisweb.cubahosting.net/";
_paq.push(['setTrackerUrl', u+'matomo.php']);
_paq.push(['setSiteId', '2']);
var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
})();


// Modal to send Mails

var correo = '';

$(function () {

    $('a.contacto').click(function () {
        correo = $(this).text();
        $('#nombre_contacto').focus();
    });

    $('#btn-enviar-contacto').click(function () {
        if (estaVacio($('#nombre_contacto').val()) || estaVacio($('#titulo_contacto').val()) || estaVacio($('#mensaje_contacto').val())) {
            alertify.error("{{ 'introduzca.datos.formulario' | trans }}");
            return false;
        }

        if (esSoloEspacios($('#nombre_contacto').val()) || esSoloEspacios($('#titulo_contacto').val()) || esSoloEspacios($('#mensaje_contacto').val())) {
            alertify.error("{{ 'introduzca.datos.formulario' | trans }}");
            return false;
        }

        $('#para_contacto').val(correo);

        $.ajax({
            url: $('#form-contacto').attr('action'),
            data: $('#form-contacto').serialize(),
            method: 'post'
        }).success(function (data) {
            $('#modal_contacto').modal('hide');
            alertify.success("{{ 'mensaje.enviado' | trans }}");
        }).error(function (err) {
            console.log("Error", err);
            alertify.error("{{ 'mensaje.no.enviado' | trans }}");
        });
    });

});