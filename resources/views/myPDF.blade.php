<!DOCTYPE html>
<html>
<head>
    <title>Certificado Laboral</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
  body{
    padding: 0;
    margin: 0;
    height: 100vh;
}

.titleDoc{
    text-align: center;
}
.nameUni{
    margin-bottom: 5%;
}
.title{
    margin-top: 2%;
    text-align: center;
    font-size: 18px;
}
.title2{
    margin-top: 2%;
    text-align: center;
    font-size: 14px;
}
.textContent{
    margin-top: 3%;
    font-size: 14px; /* Tamaño de la letra */
    font-family: Arial, sans-serif; /* Fuente Arial, con respaldo de fuentes sans-serif */
    line-height: 2em;
    text-align: justify;
}
.bodyText{
   margin-top: 3%; 
   font-size: 14px; /* Tamaño de la letra */
   font-family: Arial, sans-serif; /* Fuente Arial, con respaldo de fuentes sans-serif */
}
.foot{
    margin: 0;
}   

.foot1{
    font-size: 12px;
}
.margen{
    margin-top: 20%; 
}
.foooter{
    background: url(../);
    width: 100vw;
}
.test{
    width: 100%;
    height: auto;
    text-align: center;    
    padding: 5px;    
    box-sizing: border-box;
    font-size: 18px;
}

.container{
    width: 100%;
}
.footer{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 40px;
    text-align: center;
    color: white;
    margin-bottom: 20px;
}

.img1{
    width: 750px;    height: 90px;    margin-top: -4%;    object-fit: cover;    image-rendering: pixelated;
    margin-left: 15px;
}

.img2{
    height: 120px;    
    object-fit: cover;
    width: 800px;    
    image-rendering: pixelated;
}


.info{
    margin-top: -15%;
}

.code{
    margin-top: 18%;
}
.imgFirma{
    
}
</style>
<body>
    <div class="test">
    <img src="img/headerCertificate.jpeg" alt="" class="img1">
    </div><br><br>
    <!--"Header"-->
    <div class="container">
    <p class="title"> <b> LA FUNDACIÓN UNIVERSITARIA EMPRESARIAL DE LA CÁMARA DE COMERCIO DE BOGOTÁ
       <br> -UNIEMPRESARIAL-</b>
    </div>
    {{-- <br> --}}
    <p class="title2">  Personería Jurídica, Resolución 598 del 2 de abril de 2001 del Ministerio de Educación Nacional - Registro ICFES 2738</p>
  </p>
  <div class="test">
    <h3 >{{ $title }}</h3>
  </div>
            <p class="textContent ">Que el/la Señor/a <b class="container">{{ $name }}</b>, identificado/a con <b> {{ $t_doc }} </b> No. <b>{{ $document }}</b>; está vinculado con la Fundación Universitaria Empresarial de la Cámara de Comercio de Bogotá Uniempresarial con NIT 830.084.876-6; desempeñando el cargo de <b>{{ $contract->posts->name }}</b>,
            {{$salary}}
            {{$type_contract}}
            {{$date}}
            </p>
<!--"Footer"-->
<p class="textContent">El presente certificado se expide a solicitud del interesado a los ({{ $day }}) días del mes de {{ $month }} de {{ $year }}.</p><br>
<p class="bodyText">Atentamente, </p><br><br><br><br><br>
<div class="info">
    <img src="img/firma.png" alt="" class="imgFirma">
    <p class="foot"><b>LUZ YAZMÍN LIZARAZO JIMÉNEZ</b></strong></p>
<p class="foot2">Directora de Talento Humano</p>
</div>
<div class="code">
    <h3>Codigo de verificacion: </h3><p>{{$code}}</p>
</div>
</section class="margen"><br><br>

<footer class="footer">
    <div class="container">
        <img src="img/footerCertificate.jpeg" alt="" class="img2">
    </div>
</footer>
    
</body>
</html>
