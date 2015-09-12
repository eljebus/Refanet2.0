
var match   = '';
var bandera = false;

$(document).ready(function() {

    $('#login-pass').keyup(function() {
        // set password variable
        var pswd = $(this).val();
        match    = pswd;
        muestra_seguridad_clave(pswd);

    });


    $('#login-match').keyup(matchValidator);

});


function matchValidator(){
    console.log(1);
    var pswd = $(this).val();
    if( match === pswd ){
        $(this).css('border-color','');
        bandera = true;
    }
    else{

        $(this).css('border-color','red');
        bandera = true;
    }

        
}


var numeros="0123456789";
var letras="abcdefghyjklmnÃ±opqrstuvwxyz";
var letras_mayusculas="ABCDEFGHYJKLMNÃ‘OPQRSTUVWXYZ";

function tiene_numeros(texto)
{
   for(i=0; i<texto.length; i++)
   {
      if (numeros.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
} 

function tiene_letras(texto)
{
   texto = texto.toLowerCase();
   for(i=0; i<texto.length; i++)
   {
      if (letras.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
} 

function tiene_minusculas(texto)
{
   for(i=0; i<texto.length; i++)
   {
      if (letras.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
} 

function tiene_mayusculas(texto)
{
   for(i=0; i<texto.length; i++)
   {
      if (letras_mayusculas.indexOf(texto.charAt(i),0)!=-1)
      {
         return 1;
      }
   }
   return 0;
} 

function seguridad_clave(clave)
{
    var seguridad = 0;
    if (clave.length!=0)
    {
        if (tiene_numeros(clave) && tiene_letras(clave))
        {
            seguridad += 30;
        }
        if (tiene_minusculas(clave) && tiene_mayusculas(clave))
        {
            seguridad += 30;
        }
        if (clave.length >= 4 && clave.length <= 5)
        {
            seguridad += 10;
        }
        else
        {
            if (clave.length >= 6 && clave.length <= 8)
            {
                seguridad += 30;
            }
            else
            {
                if (clave.length > 8)
                {
                    seguridad += 40;
                }
            }
        }
    }
    
    return seguridad;               
}   

function muestra_seguridad_clave(clave){

    seguridad=seguridad_clave(clave);
    var aviso=$("#aviso");
    if(seguridad<=50)
        aviso.css("color","red");
    else
        aviso.css("color","green");
    document.getElementById("aviso").innerHTML="Seguridad: "+seguridad + " %";


    if(clave.length==0)
    {
        document.getElementById("aviso").innerHTML="";
    }
}