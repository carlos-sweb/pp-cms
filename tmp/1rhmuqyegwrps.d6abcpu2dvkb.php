<div class="flex flex-rows flex-grow w-full" id="root">
    <div class="flex flex-col gray50 br-blue500 w-60 border-right-gray300 border-right-solid border-2" >
        
        <div class="flex flex-col text-center pt-3 pb-1 text-deeppurple500">
            <span><i data-lucide="layout-dashboard" ></i></span>            
            <span class="font-bold text-3xl">pP&nbsp;cMs</span>
        </div>
        
        <div class="flex flex-col flex-grow p-2 text-deeppurple900">

            <div class="menu-items flex flex-row p-2 gray200 hover:deeppurple100 rounded cursor-pointer mt-2">
                <div class="flex flex-col justify-center"><i data-lucide="user"></i></div>
                <div class="flex flex-col justify-center pl-1 w-full " ><span>Usuarios</span></div>
            </div>            
            <div class="menu-items flex flex-row p-2 gray200 hover:deeppurple100 rounded cursor-pointer mt-2">                
                <div class="flex flex-col justify-center"><i data-lucide="database"></i></div>
                <div class="flex flex-col justify-center pl-1 w-full " ><span>Base de datos</span></div>
            </div>            
            <div class="menu-items flex flex-row p-2 gray200 hover:deeppurple100 rounded cursor-pointer mt-2">                
                <div class="flex flex-col justify-center"><i data-lucide="user"></i></div>
                <div class="flex flex-col justify-center pl-1 w-full " ><span>Usuarios</span></div>
            </div> 
            <div class="menu-items flex flex-row p-2 gray200 hover:deeppurple100 rounded cursor-pointer mt-2">
                <div class="flex flex-col justify-center"><i data-lucide="file-json-2"></i></div>
                <div class="flex flex-col justify-center pl-1 w-full " ><span>API Json</span></div>
            </div>
            
                                                    
                               
        </div>
        

    </div>
    <div class="flex flex-col flex-grow">
        <div class="flex w-full h-16 gray50 border-bottom-gray300 border-bottom-solid border-2 justify-end">
            <div class="grid content-center pl-2 pr-2">
                <div class="flex h-4 text-deeppurple900 p-3 gray300 rounded cursor-pointer">
                    <div class="flex"><img src="http://localhost/node_modules/circle-flags/flags/<?= ($locale->flag) ?>.svg" ></div>
                    <div class="flex"><span>&nbsp;<?= ($locale->flagtext) ?>&nbsp;</span></div>
                    <div class="flex flex-col"><i data-lucide="chevron-down"></i></div>                
                </div>      
            </div>            
        </div>
        <div class="flex flex-wrap flex-grow flex-col bluegray50">            
            <div class="flex flex-row p-2">
                
                <div class="flex flex-col flex-grow rounded shadow p-8 gray100">                    
                    <i data-lucide="eye" class="text-blue600"></i>
                    <span class="text-2xl font-bold pt-2">2.545</span>
                    <div>
                        <span class="text-gray600">Visitas </span>
                    <span class="text-green600">10 <i data-lucide="percent"></i> <i data-lucide="arrow-up"></i></span>
                    </div>                    
                </div>
                <div class="flex flex-col flex-grow rounded shadow  p-8 ml-2 gray100">
                    <i data-lucide="shopping-cart" class="text-blue600"></i>
                    <span class="text-2xl font-bold text-gray900 pt-4">$ 12.426.575&nbsp;<span class="text-green600">CL</span></span>
                    <div>
                        <span class="text-gray600">Ventas&nbsp;</span>
                    <span class="text-red600">10 <i data-lucide="percent"></i> <i data-lucide="arrow-down"></i></span>
                    </div>                    
                </div>
                <div class="flex flex-grow flex-col rounded shadow  p-8 ml-2 gray100">
                    <i data-lucide="user" class="text-blue600"></i>
                    <span class="text-2xl font-bold text-gray900 pt-4">300&nbsp;</span>
                    <div><span class="text-gray600">Usuarios activos&nbsp;</span></div>                    
                </div>
                <div class="flex flex-grow flex-col rounded shadow p-8 ml-2 gray100">
                    <i data-lucide="database" class="text-blue600"></i>
                    <span class="text-2xl font-bold text-gray900 pt-4">750 GB&nbsp;</span>
                    <div><span class="text-gray600">80%&nbsp;</span></div>                    
                </div>

            </div>
            

        </div>
    </div>
</div>