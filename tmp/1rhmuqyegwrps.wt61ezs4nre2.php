<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PP CMS</title>
    
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.min.css">    
    <link rel="stylesheet" href="node_modules/@fontsource/jetbrains-mono/400.css">    
    <style>
        *{font-family: 'JetBrains Mono', monospace;}
        body{background-color:#EEEEEE;}
    </style>
  </head>
  <body>
    <div class="hero is-fullheight" >
        <div class="hero-body is-justify-content-center is-align-items-center">
            <div class="columns is-flex is-flex-direction-column box" style="max-width:400px;">
                <div class="column">
                    <label for="email" class="has-text-link" >Correo Electronico<span class="has-text-danger">&nbsp;*</span></label>
                    <input class="input" type="text" placeholder="Email address">
                </div>
                <div class="column">
                    <label for="Name" class="has-text-link" >Contraseña<span class="has-text-danger">&nbsp;*</span></label>
                    <input class="input" type="password" placeholder="Password">
                    <a href="forget.html" class="is-size-7 has-text-primary">forget password?</a>
                </div>
                <div class="column">
                    <button class="button is-primary is-fullwidth" type="submit">Login</button>
                </div>
                <div class="has-text-centered">
                    <p class="is-size-7"> Don't have an account? <a href="#" class="has-text-primary">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>