
/*
 * The número de identidad de extranjero ( NIE )is a code used to identify the non-nationals in Spain
 */
 function nieES( value ) {
    "use strict";

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match( "((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)" ) ) {
        return false;
    }

    // Test NIE
    //T
    if ( /^[T]{1}/.test( value ) ) {
        return ( value[ 8 ] === /^[T]{1}[A-Z0-9]{8}$/.test( value ) );
    }

    //XYZ
    if ( /^[XYZ]{1}/.test( value ) ) {
        return (
        value[ 8 ] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(
            value.replace( "X", "0" )
                .replace( "Y", "1" )
                .replace( "Z", "2" )
                .substring( 0, 8 ) % 23
        )
        );
    }

    return false;

}

/*
 * The Número de Identificación Fiscal ( NIF ) is the way tax identification used in Spain for individuals
 */
function nifES( value ) {
    "use strict";

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match("((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)") ) {
        return false;
    }

    // Test NIF
    if ( /^[0-9]{8}[A-Z]{1}$/.test( value ) ) {
        return ( "TRWAGMYFPDXBNJZSQVHLCKE".charAt( value.substring( 8, 0 ) % 23 ) === value.charAt( 8 ) );
    }
    // Test specials NIF (starts with K, L or M)
    if ( /^[KLM]{1}/.test( value ) ) {
        return ( value[ 8 ] === String.fromCharCode( 64 ) );
    }

    return false;

}

/*
 *  identification used in Spain for individuals
 */
$.validator.addMethod( "idES", function( value ) {
    "use strict";

    if(nifES(value) == false ){
        if(nieES(value) == false){
            return false;
        }
    }

    return true;

}, "Please specify a valid NIF number." );

$( "#membership_form_type" ).change(function() {
    if( $(this).val() == "2"){
        $("#end-date").removeClass("hidden")
    }else if( $(this).val() == "1"){
        $("#end-date").addClass("hidden")
    }
});