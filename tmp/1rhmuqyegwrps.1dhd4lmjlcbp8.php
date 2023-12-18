<div class="gray100 mt-10 w-72 pb-4 rounded elevation-1 flex flex-col justify-start ">
    <form action="/login" method="POST" >
        <div class="green300 h-14 flex items-center">
            <span class="font-bold text-3xl pl-3 text-gray900" >Acceso</span>
        </div>
        <div class="flex flex-grow flex-col p-3">
            <div class="w-full pb-3" >
                <input placeholder="Correo Electrónico" autocomplete="off" name="username" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green600 text-bluegray900" type="text">
            </div>
            <div class="w-full" >
                <input placeholder="Contraseña" autocomplete="off" name="password" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green600 text-bluegray900" type="password">
            </div>
        </div>
        <div class="flex flex-row h-12 items-center justify-end pr-3" >
            <button type="submit" class="outline-none mb-1 focus:border-bluegray700 active:border-gray900 hover:border-gray600 border-gray400 border border-solid  pb-2 pt-2 pl-4 pr-4 text-center text-bluegray900 rounded font-ligh cursor-pointer" >Enviar</button>
        </div>
    </form>
</div>