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
}
.textContent{
    margin-top: 3%;
    font-family: Arial, Helvetica, sans-serif;
    line-height: 2em;
    text-align: justify;
}
.bodyText{
   margin-top: 3%; 
   font-family: Arial, Helvetica, sans-serif;
}
.foot{
    margin: 0;
}   
.foot1{
    font-size: 12px;
}
.margen{
    margin-top: 10%; 
}
.foooter{
    background: url(../);
    width: 100vw;
}
img{
    margin-left: -15%;
    width: 120%;
}
.test{
    width: 92%;
    height: auto;
    text-align: center;    
    padding: 5px;    
    box-sizing: border-box;
}

.footer{
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 40px;
    text-align: center;
    color: white;
}
.img1{
    width: 90%;    height: 80px;    margin-top: -4%;    object-fit: cover;    image-rendering: pixelated;
}

.img2{
    width: 85%;
    height: 65px;    
    object-fit: cover;
    image-rendering: pixelated;
    
}


.info{
    margin-top: 6%;
}
</style>
<body>
    <div class="test">
    <img src="img/LogoUECCB.png" alt="" class="img1">
    </div><br><br>
    <!--"Header"-->
    <div class="container">
    <p class="title"> <b> LA FUNDACIÓN UNIVERSITARIA EMPRESARIAL DE LA CÁMARA DE COMERCIO DE BOGOTÁ
    -UNIEMPRESARIAL-</b>
    </div>
    {{-- <br> --}}
    <p class="title">  Personería Jurídica, Resolución 598 del 2 de abril de 2001 del Ministerio de Educación Nacional - Registro ICFES 2738</p>
  </p>
  <div class="test">
    <h3 >{{ $title }}</h3>
  </div>
            <p class="textContent "> Que el señor/a <b class="container">{{ $name }}</b> identificado/a con <b> {{ $t_doc }} </b> No. <b>{{ $document }}</b>, está vinculado/a con la Fundación Universitaria Empresarial de la Cámara de Comercio de Bogotá Uniempresarial con NIT 830.084.876-6, desempeñando el cargo de <b>{{ $contract->posts->name }}</b>.
            {{$type_contract}}
            {{$date}}
            {{$salary}}
            </p>
<!--"Footer"-->
<p class="textContent">El presente certificado se expide a solicitud del interesado a los ({{ $day }}) días del mes de ({{ $month }}) de {{ $year }}.</p><br>
<p class="bodyText">Atentamente,</p><br>
<div class="info">
    <p class="foot">LUZ YAZMÍN LIZARAZO JIMÉNEZ</strong></p>
<p class="foot">Directora de Talento Humano</p>
<p class="foot1"><b>Proyecto:</b> Nicol Valencia – Profesional de Nómina y Contratación<br>
<b>202311031-348</b></p>
</div>

</section class="margen"><br><br>
<footer class="footer">
  <img src="img/footerpdf.png" alt="" class="img2">
</footer>
    
</body>
</html>