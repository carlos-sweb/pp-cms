<?php if (isset($js)): ?>
<?php foreach (($js?:[]) as $script): ?>
 <script type="text/javascript" src="<?= ($script) ?>" ></script>
<?php endforeach; ?>
<?php endif; ?>

   
<script type="text/javascript">

const email = "root@gmail.com";
const password = "clave";

var query = /* GraphQL */`query login($email:String!,$password:String!){login(email:$email,password:$password)}`

fetch("/api", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
  body: JSON.stringify({
    query,
    variables: { email , password },
  }),
})
.then(r => r.json())
.then(data => console.log("data returned:", data ))


 
 var router = new ppRouter({
    "/":{
        "controller":function(){
            const root  = document.getElementById("root");
            root.innerHTML = "<h1 class=\"text-bluegray500\">Hello I Am Here </h1>";
        }
    }
 });


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
 router.redirect("/");
 
 /* If you want to default Function for noFound state */
 
 router.noFound = function( location ){
     /* Put you code here */
 }
 
 /* getting enjoy you router */
 router.start("/");
 /* if you want */
 /* router.start("/my-url-base"); */
 </script>

</body></html>