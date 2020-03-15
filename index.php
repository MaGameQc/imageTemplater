




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
    <div class="alert alert-primary w-100"   style="visibility: hidden; position: fixed; top: 1em; z-index: 5;" id="alert">
        Liste Des Hashtags copié
    </div>
    
    <form action="" method="post" enctype="multipart/form-data">
            Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload" class="">
        <input type="submit" value="Upload Image" name="submit"class="btn btn-primary" >
    </form>
    
    <div class="container-fluid">
        <input type="text" id="input">
        <button id="submit" class="btn btn-primary">cliquez 2 fois pour générer thumbnail</button>
    
            <div>
                <img id="scream" src="" style="width: 10%; height: auto;" crossorigin>
                <img id="scream2" src="icons2.png" style="width: 1%; height: auto;" crossorigin>
    
            </div>

            <div>
                <div class="row">
                    <canvas id="myCanvas" height="100" width="100" style="border:1px solid #000000; position: relative;" class="mx-auto">
                    </canvas>
            </div>
            <div class="row">
                <button id="save" class="btn btn-primary mx-auto m-3">save</button>
            </div>
        
        <p style="font-family : ARCADE; color: yellow; font-size: 3rem;">shit</p>
        </div>
        <div class="row">
            <div class=" mx-auto col-md-8">
            <button id="gauche" class="btn btn-outline-primary mx-auto col-md-2">gauche</button>
            <button id="droite" class="btn btn-outline-primary mx-auto col-md-2">droite</button>
        
            <button id="haut" class="btn btn-outline-primary mx-auto col-md-2">haut</button>
            <button id="bas" class="btn btn-outline-primary mx-auto col-md-2">bas</button>
            </div>
            
            
        </div>
        
        <select id="selecteur">
              <option value="icones">icones</option>
              <option value="titre">titre</option>
            </select>
    </div>

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




<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
			  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
		



<script>

$("#submit").on("click", function(){
    
    if($("#input").val() == ""){
        $("#scream").attr("src", <?php echo json_encode($image); ?>);
    }
    if($("#input").val() != ""){
        $("#scream").attr("src", "uploads/" + $("#input").val());
    }
    
   
   

   
   var img = document.getElementById('scream'); 
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
    
    var percentPaddingLeft = (2*Width)/100;
    var percentPaddingTop = (5*Height)/100;

  var c = document.getElementById("myCanvas");
  var ctx = c.getContext("2d");
  var img = document.getElementById("scream");
  
  
      ctx.drawImage(img, 0, 0);
    ctx.drawImage(document.getElementById("scream2"), percentPaddingLeft, percentPaddingTop, percentWidthIcons, percentHeightIcons);
    ctx.shadowColor="black";
    ctx.shadowBlur=5;
    ctx.lineWidth=5;
    ctx.textAlign = 'center';
    ctx.fillStyle = 'rgb(255, 170, 0)';
    ctx.font = "4.5rem ARCADE";
    ctx.fillText("MaGame Podcast", Width/2, 60); 
    ctx.font = "2.5rem ARCADE";
    ctx.fillText("en direct les mercredis 21h15", Width/2, 90); 
  
   
  




   var deplacementGauche = percentPaddingLeft;
 var deplacementTop = percentPaddingTop;
 
 var newPositionLeftRight;
  var newPositionUpDown;
  
  ////////////////////
  
 var horizontalTitlePosition = Width/2;
 var verticalTitlePosition = 60;
 
 var newHorizontalTitlePosition = 0;
 var newVerticalTitlePosition = 0;
 
    $("#gauche").click(function(){
        
        if( $("#selecteur ").val() == "icones" ){
            console.log("shit"); 
            percentPaddingLeft - (deplacementGauche -= 8);
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        } 
        
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition -= 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
        
    });
    
    $("#droite").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingLeft - (deplacementGauche += 8);
       newPositionLeftRight = deplacementGauche;
       newPositionUpDown = deplacementTop;
       drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            horizontalTitlePosition += 8;
            newHorizontalTitlePosition = horizontalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
    });
    
    $("#haut").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingTop - (deplacementTop -= 8);
       newPositionUpDown = deplacementTop;
       newPositionLeftRight = deplacementGauche;
       drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
             verticalTitlePosition -= 8;
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
    });
    
    $("#bas").click(function(){
        if( $("#selecteur ").val() == "icones" ){
       console.log("shit"); 
       percentPaddingTop - (deplacementTop += 8);
       newPositionUpDown = deplacementTop;
       newPositionLeftRight = deplacementGauche;
       drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        } 
        if ( $("#selecteur ").val() == "titre" ){
            console.log("returned");
            verticalTitlePosition += 8;
            newVerticalTitlePosition = verticalTitlePosition;
            //
            newPositionLeftRight = deplacementGauche;
            newPositionUpDown = deplacementTop;
            //
            drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition);
        }
    });

   
});





function drawLeftRight(img, Width, Height, WidthIcons, HeightIcons, percentWidthIcons, percentHeightIcons, newPositionLeftRight, newPositionUpDown, c, ctx, horizontalTitlePosition, verticalTitlePosition){
    ctx.drawImage(img, 0, 0);
    ctx.drawImage(document.getElementById("scream2"), newPositionLeftRight, newPositionUpDown, percentWidthIcons, percentHeightIcons);
    ctx.shadowColor="black";
    ctx.shadowBlur=5;
    ctx.lineWidth=5;
    ctx.textAlign = 'center';
    ctx.fillStyle = 'rgb(255, 170, 0)';
    ctx.font = "4.5rem ARCADE";
    ctx.fillText("MaGame Podcast", horizontalTitlePosition, verticalTitlePosition); 
    ctx.font = "2.5rem ARCADE";
    ctx.fillText("en direct les mercredis 21h15", horizontalTitlePosition, verticalTitlePosition + 30); 
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
