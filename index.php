




<?php
    $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$image = "uploads/" . $_FILES["fileToUpload"]["name"]; 
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 6000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded. </br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}





$images2 = preg_grep('/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?$/i', $files);
 
if ($handle = opendir('uploads')) {
 
    while (false !== ($entry = readdir($handle))) {
        $files[] = $entry;
    }
    $images2 = preg_grep('/\.jpg$/i', $files);
 
    foreach($images2 as $image2)
    {
      echo "<input value='$image2'>" . '<br/>'; // List all Images
    }
    closedir($handle);
}


?>



<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">     
        <!--font awesome-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
            
        <!--feuille css externe qui link le font dans canvas    -->
        <link rel="stylesheet" type="text/css" href="style.css">
         
         <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    
<body>
<div class="container-fluid ">
<div class="row">
    <div class="container-fluid text-center">
    <h1 class="">Créateur De Thumbnail</h1>
    <p>pour post facebook et thumbnail youtube</p>
</div>
</div>
    
    <div class="alert alert-primary w-100"   style="visibility: hidden; position: fixed; top: 1em; z-index: 5;" id="alert">
        Liste Des Hashtags copié
    </div>
    
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            choisir l'image à uploader: 
            <input type="file" name="fileToUpload" id="fileToUpload" class="">
        </div>
        
        <div class="row">
        <input type="submit" value="Upload Image" name="submit"class="btn btn-primary" >
        </div>
    </form>
    
    <div class="container-fluid">
        <div class="row">
        <label>coller l'url d'une image déjà hébergé sur le serveur</label>
        </div>
        
       
            
            <div class="row">
                <p>prévisualisation de l'image</p>
            </div>
            <div>
                <img id="scream" src="" style="width: 10%; height: auto;" crossorigin>
                <img id="scream2" src="icons2.png" style="width : 1%; height:auto;" crossorigin>
    
            </div>
            

            <div>
                <div class="row">
                    <div class="container col-3">

            <div class="row">
                <button id="gauche" class="btn btn-outline-primary mx-auto col">gauche</button>
            </div>
            <div class="row">
                <button id="droite" class="btn btn-outline-primary mx-auto col">droite</button>
            </div>
            <div class="row">
                <button id="haut" class="btn btn-outline-primary mx-auto col">haut</button>
            </div>
            <div class="row">
                <button id="bas" class="btn btn-outline-primary mx-auto col">bas</button>
            </div>
            <div class="row">
                <button id="taillePlus" class="btn btn-outline-primary mx-auto col">taille +</button>
            </div>
            <div class="row">
                <button id="tailleMoin" class="btn btn-outline-primary mx-auto col">taille -</button>
            </div>
            
            
            
         <div class="row">
        <input type="text" id="input">
        <button id="submit" class="btn btn-primary">cliquez 2 fois pour générer thumbnail</button>
        </div>
            
            
            <!--face    -->
            <p>selecteur d'image icones/visages</p>
            <select id="selecteurFace">
              <option value="icons">icones</option>
              <option value="face1">face 1</option>
              <option value="face2">face 2</option>
            </select>
            
            
            <p>sélecteur d'élément à déplacer</p>
        <select id="selecteurDeplacement">
              <option value="icons">icones</option>
              <option value="titre">titre</option>
            </select>
            
             <p>sélecteur d'élément à déplacer</p>
        <select id="selecteurCouleur">
              <option value="rgb(255, 170, 0)">orange</option>
              <option value="rgb(7, 236, 7)">vert</option>
              <option value="rgb(7, 213, 236)">bleue</option>
            </select>
            
            
            
            
             <div class="row" style="background-color : grey;">
            <p> Taille Image Secondaire :  </p><p id="labelRangeFace"></p>
<input type="range" class="custom-range col-md-6 mx-auto" id="customRangeFace">
<!--Range inputs have implicit values for min and max—0 and 100, respectively. You may specify new values for those using the min and max attributes.-->
</div>


<div class="row" style="background-color : #ccc8c8;">
            <p> Taille texte :  </p><p id="labelRangeTextSize"></p>
<input type="range" class="custom-range col-md-6 mx-auto" id="customRangeTextSize">
<!--Range inputs have implicit values for min and max—0 and 100, respectively. You may specify new values for those using the min and max attributes.-->
</div>

<div class="row" style="background-color : blue; color: white;">
            <p> Rotation Image :  </p><p id="labelRangeImageRotation"></p>
<input type="range" min="-180" max="180" class="custom-range col-md-6 mx-auto" id="customRangeImageRotation">
<!--Range inputs have implicit values for min and max—0 and 100, respectively. You may specify new values for those using the min and max attributes.-->
</div>

<div class="row" style="background-color : black; color: white;">
            <p> Rotation texte :  </p><p id="labelRangeTextRotation"></p>
<input type="range" min="-180" max="180" class="custom-range col-md-6 mx-auto" id="customRangeTextRotation">
<!--Range inputs have implicit values for min and max—0 and 100, respectively. You may specify new values for those using the min and max attributes.-->
</div>
            
            
            
        </div>
                    <canvas id="myCanvas" height="100" width="100" style="border:1px solid #000000; position: relative;" class="mx-auto col-md-8 p-0">
                    </canvas>
            </div>
            
            
            
           
            
            
            <div class="row">
                <button id="save" class="btn btn-primary mx-auto m-3">save</button>
            </div>
        
        <p style="font-family : ARCADE; color: yellow; font-size: 3rem;">shit</p>
        </div>
        
        
        
    </div>
    
    <label>changer le titre</label>
    <input type="text" id="titleInput">
    
    <label>changer le sout-titre</label>
    <input type="text" id="subTitleInput">
    <button id="changeTitle" class="btn btn-primary">appliquer</button>
    
    

            
                
                
                
            

<div class="container-fluid">
    <div class="row">
        <p id="hashtags" class="col-6 mx-auto">
            pour télécharger un podcast version audio ou lire des articles sur l’actualité gaming, rend toi au www.MaGame.ca
            #gaming #jeuxvideo #qc #quebec #quebecois #podcast #balado #actualité #MaGame #pc #gamingpc #xbox #xboxone #microsoft #sony #playstation #playstation4 #ps4 #nintendo #nintendoswitch #pcmasterrace #jeux #canadien #canada #angrybirds #rovio #epicgames #epicgamestore #overwatch #scarlettjohansson
        </p>
    </div>
    <div class="row">
        <button id="copyHash" class="btn btn-primary mx-auto " >copie #</button>
    </div>
</div>


























</div>

<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
		



<script>

//code empêchant la scroll down si fleche appuyer
window.addEventListener("keydown", function(e) {
    // space and arrow keys
    if([ 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
        e.preventDefault();
    }
}, false);



//quand thumbnail est généré

$("#submit").on("click", function(){
    
    //si zone url est vide ou pleine
    if($("#input").val() == ""){
        $("#scream").attr("src", <?php echo json_encode($image); ?>);
    }
    if($("#input").val() != ""){
        $("#scream").attr("src", "uploads/" + $("#input").val());
    }
    
   
    
    var couleur = $("#selecteurCouleur").val();
    
    
     function Canvas(canvas, ctx, img, defaultPositionLeftTitle, defaultPositionTopTitle, rotationText, icons){
         this.canvas = canvas;
         this.ctx = ctx;
         this.img = img;
         this.defaultPositionLeftTitle = defaultPositionLeftTitle;
         this.defaultTextSize = defaultTextSize;
         this.rotationText = rotationText;
         this.icons = icons;
         
         
         this.drawBackground = function(){
             ctx.drawImage(img, 0, 0);
         }
         
         this.drawTitle = function(){
             ctx.shadowColor="black";
            ctx.shadowBlur=5;
            ctx.lineWidth=5;
            ctx.textAlign = 'center';
            ctx.fillStyle = couleur;
            ctx.font = (defaultTextSize + "px") + " ARCADE";
            ctx.fillText(customTitle, defaultPositionLeftTitle, defaultPositionTopTitle);
            ctx.font = (defaultTextSize/2 + "px") + " ARCADE"; 
            ctx.fillText(customSubTitle, defaultPositionLeftTitle, defaultPositionTopTitle+30);
         }
         
         
         this.drawIcons = function(){
             ctx.drawImage(icons, percentPaddingLeft, percentPaddingTop, percentWidthIcons, percentHeightIcons);
             console.log("piece of shit");
         }
         
         
         this.textLeft = function(){
            defaultPositionLeftTitle -=8;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
            console.log("text left");
         }
         this.textRight = function(){
            defaultPositionLeftTitle +=8;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
            console.log("text Right");
         }
         this.textUp = function(){
            defaultPositionTopTitle -= 8;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
            console.log("text up");
         }
         this.textDown = function(){
            defaultPositionTopTitle += 8;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
            console.log("text down");
         }
         
         this.changeTitle = function(){
             customTitle = $("#titleInput").val();
            if($("#subTitleInput").val() != ""){
                customSubTitle = $("#subTitleInput").val();
            }
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         this.changeTextSize = function(){
             $('#customRangeTextSize[type=range]').on('input', function () {
                defaultTextSize = $(this).val() * 2.2;
            });
         console.log("size of text has been changed");
         }
         
         this.changeTitleColor = function(){
             couleur = $("#selecteurCouleur").val();
             this.erase();
             this.drawBackground();
             this.drawTitle();
             this.drawIcons();
         }
         
         
         this.changeTextRotation = function(){
             $('#customRangeTextRotation[type=range]').on('input', function () {
                Canvas.erase(); // erase to save cache
                Canvas.drawBackground();
                ctx.save(); // save current state
                rotationText = $(this).val();
                ctx.translate(defaultPositionLeftTitle, defaultPositionTopTitle);
                ctx.rotate(rotationText * Math.PI / 180);
                ctx.translate(-defaultPositionLeftTitle, -defaultPositionTopTitle);
                Canvas.drawTitle();
                ctx.restore(); // restore original states (no rotation etc)
                Canvas.drawIcons();
            });
            console.log("text rotation has been Changed " + rotationText);
         }
         
         
         this.iconsLeft = function(){
            percentPaddingLeft -= 6;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         this.iconsRight = function(){
            percentPaddingLeft += 6;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         this.iconsUp = function(){
            percentPaddingTop -= 6;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         this.iconsDown = function(){
            percentPaddingTop += 6;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         this.changeIconsSize = function(){
            percentWidthIcons = ($("#customRangeFace").val() / 3) * Width / 100;
            percentHeightIcons = ($("#customRangeFace").val()*19 / 3) * Height / 100;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         
         
         this.changeFaceSize = function(){
            percentWidthIcons = ($("#customRangeFace").val()*Width)/100;
            percentHeightIcons = ($("#customRangeFace").val()*Height)/100;
            this.erase();
            this.drawBackground();
            this.drawTitle();
            this.drawIcons();
         }
         
         this.secondaryImageRotation = function(){
             $('#customRangeImageRotation[type=range]').on('input', function () {
                Canvas.erase(); // erase to save cache
                Canvas.drawBackground();
                Canvas.drawTitle();
                ctx.save(); // save current state
                rotationImage = $(this).val();
                ctx.translate(percentPaddingLeft + percentWidthIcons/2, percentPaddingTop +  percentHeightIcons/2);
                ctx.rotate(rotationImage * Math.PI / 180);
                ctx.translate(-percentPaddingLeft - percentWidthIcons/2,  -percentPaddingTop - (percentHeightIcons/2));
                Canvas.drawIcons();
                ctx.restore(); // restore original states (no rotation etc)
                
            });
         }
         
         
         this.erase = function(){
             ctx.clearRect(0, 0, canvas.width, canvas.height);
             
         }
         this.save = function(){
             ctx.save();
         }
         this.restore = function(canvas, ctx, title){
             ctx.restore();
         }
     }
     
     
     
     
    /* function Title(canvas, ctx, title, lefty){
         this.canvas = canvas;
         this.ctx = ctx;
         this.title = title;
         this.lefty = lefty;
         
         this.drawTitle = function(){
             ctx.shadowColor="black";
            ctx.shadowBlur=5;
            ctx.lineWidth=5;
            ctx.textAlign = 'center';
            ctx.fillStyle = couleur;
            ctx.font = "60px ARCADE";
            ctx.fillText(title, Width/2, lefty);
            ctx.font = "30px ARCADE"; 
            ctx.fillText("en direct les mercredis 21h15", Width/2, 90);
         }
         
         this.slideDown = function(){
             lefty-=3;
             this.drawTitle();
         }
         
     }
     
     */
    
   var img = document.getElementById('scream'); 
   var defaultPositionLeftTitle = img.naturalWidth/2;
   var defaultPositionTopTitle = 60;
   var defaultTextSize = 60;
   var icons3 = document.getElementById('scream2');
   var rotationImage = 0;
   
   
   
   
    //or however you get a handle to the IMG
    var Width = img.naturalWidth;
    var Height = img.naturalHeight;
    //console.log("width" + Width);
    var WidthIcons = document.getElementById('scream2').width;
    var HeightIcons = document.getElementById('scream2').height;

    document.getElementById('myCanvas').width = Width;
    document.getElementById('myCanvas').height = Height;
    
        
        
    var percentWidthIcons = (5*Width)/100;
    var percentHeightIcons = (90*Height)/100;
    
    var variantPercentLeft = 2;
    var variantPercentTop = 5;
    var percentPaddingLeft = (variantPercentLeft*Width)/100;
    var percentPaddingTop = (variantPercentTop*Height)/100;

  var c = document.getElementById("myCanvas");
  var ctx = c.getContext("2d");
  var defaultTitle = "shit";
  var lefty = 0;
  
   var customTitle = "MaGame Podcast";
 var customSubTitle = "en direct les mercredis 21h15";
  
  var Canvas = new Canvas(c, ctx, img, defaultPositionLeftTitle, defaultPositionTopTitle, defaultTextSize, icons3);
  
  
  
  Canvas.drawBackground();
  Canvas.drawTitle();
  Canvas.drawIcons();

  
  
  
   $(document).keydown(function(e){
               if (e.which ==37 ) { 
                    if( $("#selecteurDeplacement").val() == "titre" ){
                        Canvas.textLeft();
                    }
                    if( $("#selecteurDeplacement").val() == "icons" ){
                        Canvas.iconsLeft();
                        
                        console.log("variantPercentLeft");
                    }
            } 
            
            if (e.which == 39) { 
                    if( $("#selecteurDeplacement").val() == "titre" ){
                        Canvas.textRight();
                    }
                    if( $("#selecteurDeplacement").val() == "icons" ){
                        Canvas.iconsRight();
                        console.log("variantPercentLeft");
                    }
            }
            if (e.which == 38) {
                    if( $("#selecteurDeplacement").val() == "titre" ){
                        Canvas.textUp();
                    }
                    if( $("#selecteurDeplacement").val() == "icons" ){
                        Canvas.iconsUp();
                        console.log("variantPercentLeft");
                    }
            }
            if (e.which == 40) {
                    if( $("#selecteurDeplacement").val() == "titre" ){
                        Canvas.textDown();
                    }
                    if( $("#selecteurDeplacement").val() == "icons" ){
                        Canvas.iconsDown();
                        console.log("variantPercentLeft");
                    }
            }
   });
   
   
   
    $('#customRangeTextSize[type=range]').on('input', function () {
        Canvas.changeTextSize();
        Canvas.erase();
                Canvas.drawBackground();
                Canvas.drawTitle();
                Canvas.drawIcons();
    });
    
     $('#customRangeTextRotation[type=range]').on('input', function () {
                Canvas.changeTextRotation();
                Canvas.erase();
    });
    
    $('#customRangeImageRotation[type=range]').on('input', function () {
                Canvas.secondaryImageRotation();
                Canvas.erase();
    });
    
     $('#customRangeFace[type=range]').on('input', function () {
         
         
        if($("#selecteurFace").val() == "icons"){
            Canvas.changeIconsSize();
        }
        
        if($("#selecteurFace").val() == "face1"){
            Canvas.changeFaceSize();
        }
     });

  //var img = document.getElementById("scream");
  
  
     /* ctx.drawImage(img, 0, 0);
    ctx.drawImage(document.getElementById("scream2"), percentPaddingLeft, percentPaddingTop, percentWidthIcons, percentHeightIcons);
    ctx.shadowColor="black";
    ctx.shadowBlur=5;
    ctx.lineWidth=5;
    ctx.textAlign = 'center';
    ctx.fillStyle = couleur;
    ctx.font = "60px ARCADE";
    ctx.fillText("MaGame Podcast", Width/2, 60); 
    ctx.font = "30px ARCADE"; 
    ctx.fillText("en direct les mercredis 21h15", Width/2, 90); */
      
    
 
   
  




   var deplacementGauche = percentPaddingLeft;
 var deplacementTop = percentPaddingTop;
 
 var newPositionLeftRight;
  var newPositionUpDown;
  
  ////////////////////
  
 var horizontalTitlePosition = Width/2;
 var verticalTitlePosition = 60;
 
 var newHorizontalTitlePosition = 0;
 var newVerticalTitlePosition = 0;
 

 
 var originalTextSize = 60;
 var newTextSize = 0;
 
 var originalRotation = 0;
 var newRotation = 0;
 
 var originalTextRotation = 0;
 var newTextRotation = 0;
 
 
 
 
 
 
 
 



    $("#changeTitle").click(function(){
       Canvas.changeTitle();
    });
 
 
 
 $("#selecteurCouleur").change(function(){
     couleur = $("#selecteurCouleur").val(); 
     Canvas.changeTitleColor();
 });
 
 
 
 
 
 $("#selecteurFace").change(function(){
    switch($("#selecteurFace").val()) {
        case "icons":
            $("#scream2").attr("src", "icons2.png");
            $("#scream2").css("width", "1%");
            $("#scream2").css("height", "auto");
            Canvas.erase();
            Canvas.drawBackground();
            Canvas.drawTitle();
            Canvas.drawIcons();
        break;
        
        case "face1":
            $("#scream2").attr("src", "faces/whatTheFuck.png");
            $("#scream2").css("width", "5%");
            $("#scream2").css("height", "auto");
                Canvas.erase();
                Canvas.drawBackground();
                Canvas.drawTitle();
                Canvas.drawIcons();
                Canvas.changeFaceSize();
        break;
    
        case "face2":
            $("#scream2").attr("src", "faces/meme.jpg");
        break;
        
        default:
        console.log("error");
    }
 });
    

 
 
    /*$("#gauche").click(function(){
        if( $("#selecteur ").val() == "icones" ){
            console.log("shit"); 
            percentPaddingLeft - (deplacementGauche -= 8);
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        } 
        
        if ( $("#selecteurDeplacement ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition -= 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
        
    });*/
    
    /*$("#droite").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingLeft - (deplacementGauche += 8);
       newPositionLeftRight = deplacementGauche;
       newPositionUpDown = deplacementTop;
        if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition += 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
    });*/
    
   /* $("#haut").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingTop - (deplacementTop -= 8);
       newPositionUpDown = deplacementTop;
       newPositionLeftRight = deplacementGauche;
        if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
             verticalTitlePosition -= 8;
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
    });*/
    
    /*$("#bas").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingTop - (deplacementTop += 8);
       newPositionUpDown = deplacementTop;
       newPositionLeftRight = deplacementGauche;
       newTextSize = originalTextSize + "";
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        } 
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            verticalTitlePosition += 8;
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
            
        }
    });*/
    

    /*$("#taillePlus").click(function(){
         if ( $("#selecteur ").val() == "titre" ){
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
        console.log("grossissement du texte");
        originalTextSize += 0.5;
         if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
        console.log(newTextSize + " new");
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);    
         }
         });*/
    
        /*$("#tailleMoin").click(function(){
         if ( $("#selecteur ").val() == "titre" ){
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
        console.log("grossissement du texte");
        originalTextSize -= 0.5;
         if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
        console.log(newTextSize + " new");
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);    
         }
         });*/
    
    $("#changeTitleasdfsdfsaf").click(function(){
       console.log("title is changed");
       
        newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
       customTitle = $("#titleInput").val();
       if($("#subTitleInput").val() != ""){
           customSubTitle = $("#subTitleInput").val();
       }
        if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);    
        
    });

   $(document).keydown(function(e){
    /*if (e.which == 37) { 
       if( $("#selecteur ").val() == "icones" ){
            console.log("shit"); 
            percentPaddingLeft - (deplacementGauche -= 8);
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
           
       } 
        
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition -= 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
       
    }*/
     /*if (e.which == 38) { 
       if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingTop - (deplacementTop -= 8);
       newPositionUpDown = deplacementTop;
       newPositionLeftRight = deplacementGauche;
        if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
           
       }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
             verticalTitlePosition -= 8;
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
       
    }*/
     /*if (e.which == 39) { 
       if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingLeft - (deplacementGauche += 8);
       newPositionLeftRight = deplacementGauche;
       newPositionUpDown = deplacementTop;
        if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
           
       }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition += 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
             if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
            
        }
       
    }*/
     /*if (e.which == 40) { 
         Canvas.draw(c, ctx, img);
       
       } */
       
       ///drawdraw
    
});


//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////
             //////////////////////////////////////////////////////////////
                      //////////////////////////////////////////////////////////////

/*$("#selecteurFace").change(function(){
    switch($("#selecteurFace").val()) {
  case "icones":
    $("#scream2").attr("src", "icons2.png");
    $("#scream2").css("width", "1%");
    $("#scream2").css("height", "auto");
    break;
  case "face1":
    $("#scream2").attr("src", "faces/whatTheFuck.png");

    break;
    
    case "face2":
    $("#scream2").attr("src", "faces/meme.jpg");
    break;
  default:
    // code block
}
});*/

/*$("#selecteurFace").change(function(){
    switch($("#selecteurFace").val()) {
  case "icones":
    $("#scream2").attr("src", "icons2.png");
    $("#scream2").css("width", "1%");
    $("#scream2").css("height", "auto");
    
                newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            /*if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }*/
/*drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
          
    break;
  case "face1":
    $("#scream2").attr("src", "faces/whatTheFuck.png");
                newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            /*if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }*/
/*drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);        
          

    break;
    
    case "face2":
    $("#scream2").attr("src", "faces/meme.jpg");
    break;
  default:
  
}
});*/




    
    /*$('#customRangeFace[type=range]').on('input', function () {
        if($("#selecteurFace").val() == "face1"){
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
            percentWidthIcons = ($(this).val()*Width)/100;
            percentHeightIcons = ($(this).val()*Height)/100;
            $("#labelRangeFace").html($(this).val());
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);
        }
        
        if($("#selecteurFace").val() != "face1"){
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
            percentWidthIcons = $(this).val() * 2;
            percentHeightIcons = ($(this).val()*Height)/100 * 2;
            $("#labelRangeFace").html($(this).val());
drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);
        }
            
    });*/
    

     /*$('#customRangeText[type=range]').on('input', function () {
                     //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
        newTextSize = $(this).val()*2;
        $("#labelRangeText").html($(this).val());
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);
    });*/
    
    
    
   /* $('#customRangeRotation[type=range]').on('input', function () {
                     //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
        newRotation = $(this).val();
        console.log(newRotation);
        $("#labelRangeRotation").html($(this).val() * 2);
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);
    });*/
    
    
    
   /* $('#customRangeTextRotationasfsafsaasdf[type=range]').on('input', function () {
                     //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            
            if($("#customRangeText").val() == 50){
                newTextSize = originalTextSize ;
            }
            if($("#customRangeText").val() != 50){
                newTextSize = newTextSize ;
            }
        newTextRotation = $(this).val();
        console.log(newRotation);
        $("#labelRangeTextRotation").html($(this).val() * 2);
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation);
    });*/
   
});




function drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition, customTitle, customSubTitle, newTextSize, couleur, newRotation, newTextRotation){
    
    ctx.drawImage(img, 0, 0);
    ctx.save(); // save current state
    
    //ctx.translate(newPositionLeftRight , percentHeightIcons/2);
    
ctx.rotate(newRotation * Math.PI / 180);

    ctx.drawImage(document.getElementById("scream2"), newPositionLeftRight, newPositionUpDown, percentWidthIcons, percentHeightIcons);
    ctx.restore(); // restore original states (no rotation etc)
    ctx.shadowColor="black";
    ctx.shadowBlur=5;
    ctx.lineWidth=5;
    ctx.textAlign = 'center';
    ctx.fillStyle = couleur;
    
    ctx.save(); // save current state
    ctx.rotate(newTextRotation * Math.PI / 180);
    
    ctx.font =  (newTextSize + "px") + " ARCADE";
    ctx.fillText(customTitle, horizontalTitlePosition, verticalTitlePosition); 
    ctx.font =   (newTextSize/2 + "px") + " ARCADE";
    ctx.fillText(customSubTitle, horizontalTitlePosition, verticalTitlePosition + 30); 
    ctx.restore(); // restore original states (no rotation etc)
    
    


    
    
}




$("#save").click(function(){
     var canvas = document.getElementById("myCanvas");
  image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");
  var link = document.createElement('a');
  link.download = "my-image.png";
  link.href = image;
  link.click();
});


$("#copyHash").click(function(){
    $('#alert').css("visibility", "visible");
    
    let hashtags = $("#hashtags").text();
    textToClipboard(hashtags);
			function textToClipboard (text) {
				var dummy = document.createElement("textarea");
				document.body.appendChild(dummy);
				dummy.value = text;
				dummy.select();
				document.execCommand("copy");
				document.body.removeChild(dummy);
				
				setTimeout(function(){ $('#alert').css("visibility", "hidden"); }, 2000);
			}
			
});


</script>



</body>
</html>
