<!DOCTYPE html>
<html lang="en" class="flex w-full h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/dist/master.css">    
    <link href="/fonts/Ubuntu/index.css" rel="stylesheet">
    <style>*{font-family: 'Ubuntu', sans-serif;}</style>
    <title>pp-cms</title>
</head>
<body>
    

    <form action="/api" method="POST" >
        <label for="email">
            User
            <input type="text" id="email" value="user" />        
        </label>
        <label for="pwd">
            Pass
            <input type="text" id="pwd" value="123456" >
        </label>
        <button rol="submit">Send</button>

    </form>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
/*
https://www.youtube.com/watch?v=FaUtq-NNZyU
*/    



async function send(){
   const response = await fetch('http://localhost/api', {
    method: 'POST',
    headers: {
        'Accept-Encoding': 'gzip, deflate, br',
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Connection': 'keep-alive',
        'Origin': 'altair://-'
    },
    body: JSON.stringify({
        query: 'query( $msj: String! ){ echo(message: $msj ) }',
        variables: {
            msj :"Carlos!!!!"
        }
    })
    });

    const data = await response.json()

    console.log( data );

 
}

send();
   
   


</script>
</body>
</html>