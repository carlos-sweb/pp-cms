<?php foreach (($js?:[]) as $script): ?>
 <script type="text/javascript" src="<?= ($script) ?>" ></script>
<?php endforeach; ?>


<script type="text/javascript">
    /*Declare root html element*/
 var root = document.getElementById("root");
 
 /*Declare router here*/
 var router = new ppRouter(
     /*How to use it ?*/
     {
     "/":{
         controller:function(){
                          
             
         }
     },
     "/route-remove":{
         controller:function(){
             root.innerHTML = `<h1>Route Remove</h1>`;
         }
     }
     }
 );
 
 router.addRoute("/usuarios",{
    controller:function( params){

    }
 });
 /*If you want to add another router*/
 router.addRoute("/vegetables/:name(string)/:id(number)",
     {
         controller:function( params ){				
             root.innerHTML = `<h1>vegetables ${params.name} : ${params.id} </h1>`;
         }
     }
 );
 
 /* If you want to remove any route */
 router.removeRoute("/route-remove");
 
 /* If you want to default redirect */
 router.redirect("/usuarios");
 
 /* If you want to default Function for noFound state */
 
 router.noFound = function( location ){
     /* Put you code here */
 }
 
 /* getting enjoy you router */
 //router.start("usuarios");
 /* if you want */
 /* router.start("/my-url-base"); */
 </script>


</body></html>