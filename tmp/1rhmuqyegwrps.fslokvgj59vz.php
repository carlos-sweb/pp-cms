<div class="gray100 mt-10 pb-4 rounded shadow-2 flex flex-col justify-start w-96" >
    <form action="/install" method="POST" autocomplete="off">
        <input type="hidden" name="csrf" type="text" value="<?= ($CSRF) ?>" >
        <div class="green300 h-14 flex items-center">
            <span class="font-bold text-3xl pl-3 text-gray900" >Instalación</span>
        </div>
        <div class="flex flex-grow flex-col p-3">
            <div class="w-full pb-3 flex flex-col" >
                <label for="database" class="pt-1 pb-2 text-bluegray900">Base de datos</label>
                <input placeholder="ppcms" autocomplete="off" name="database" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green400 focus:shadow-around-green300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="text" value="<?= ($db['NAME']) ?>" >
            </div>
            <div class="w-full pb-3 flex flex-col" >
                <label for="username" class="pt-1 pb-2 text-bluegray900">Usuario</label>
                <input placeholder="root" autocomplete="off" name="username" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green400 focus:shadow-around-green300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="text" value="<?= ($db['USER']) ?>" >
            </div>
            <div class="w-full pb-3 flex flex-col" >
                <label for="password" class="pt-1 pb-2 text-bluegray900">Contraseña</label>
                <input placeholder="12345678" autocomplete="off" name="password" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green400 focus:shadow-around-green300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="text" value="<?= ($db['PASS']) ?>" >
            </div>
            <div class="w-full flex flex-col" >
                <label for="host" class="pt-1 pb-2 text-bluegray900">Anfitrión de la Base de Datos</label>
                <input placeholder="localhost" autocomplete="off" name="host" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-green400 focus:shadow-around-green300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="text" value="<?= ($db['HOST']) ?>">
            </div>
        </div>
        <div class="flex flex-row h-12 items-center justify-end pr-3" >
            <button type="submit" class="outline-none mb-1 focus:border-bluegray700 active:border-gray900 hover:border-gray600 border-gray400 border border-solid  pb-2 pt-2 pl-4 pr-4 text-center text-bluegray900 rounded font-ligh cursor-pointer" >Instalar</button>
        </div>
    </form>
</div>