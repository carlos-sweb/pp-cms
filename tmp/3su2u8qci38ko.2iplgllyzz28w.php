
<div class="flex flex-col text-center mt-4 pt-3 pb-1 text-deeppurple500">
    <span><i data-lucide="layout-dashboard" ></i></span>            
    <span class="font-bold text-3xl">pP&nbsp;cMs</span>
</div>




<div class="gray100 mt-4 pb-4 rounded-md shadow-2 flex flex-col justify-start w-90" >
    <form action="/es/admin/dashboard" method="POST" autocomplete="off">
        <input type="hidden" name="csrf" type="text" value="<?= ($CSRF) ?>" >
                
        <div class="h-12 flex items-center rounded-tl-md rounded-tr-md pl-3 pr-1 border-bottom-solid border-bottom-deeppurple200 border-2">
            <span class="text-3xl text-deeppurple700 flex-grow" >
                <?php if (isset($locale['title'])): ?><?= ($locale['title']) ?>&nbsp;<?php endif; ?>
            </span>
            <div class="flex flex-row h-4 text-deeppurple900 p-3 gray300 rounded cursor-pointer">
                <div class="flex">
                    <?php if (isset($locale->flag)): ?>
                        <img src="http://localhost/node_modules/circle-flags/flags/<?= ($locale->flag) ?>.svg" >
                    <?php endif; ?>  
                </div>

                <div class="flex">
                    <?php if (isset($locale->flagtext)): ?>
                        <span>&nbsp;<?= ($locale->flagtext) ?>&nbsp;</span>
                    <?php endif; ?>
                </div>
                <div class="flex flex-col"><i data-lucide="chevron-down"></i></div>                
            </div>            
        </div>

        <div class="flex flex-grow flex-col p-3">            
            <div class="w-full pb-3 flex flex-col" >
                <?php if (isset($locale->form->username)): ?>
                <label for="username" class="pt-1 pb-2 text-bluegray900"><?= ($locale->form->username) ?></label>
                <?php endif; ?>
                <input placeholder="root" autocomplete="off" name="username" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-deeppurple400 focus:shadow-around-deeppurple300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="text" value="<?= ($db['USER']) ?>" >
            </div>
            <div class="w-full pb-3 flex flex-col" >
                <?php if (isset($locale->form->password)): ?>
                <label for="password" class="pt-1 pb-2 text-bluegray900"><?= ($locale->form->password) ?></label>
                <?php endif; ?>
                <input placeholder="12345678" autocomplete="off" name="password" class="outline-none appearance-none rounded border-solid border-gray400 border border-solid h-7 pt-1 pb-1 pl-2 pr-2 focus:border focus:border-deeppurple400 focus:shadow-around-deeppurple300 text-bluegray900 transition-duration-200 transition-property-all transition-timing-ease" type="password" value="<?= ($db['PASS']) ?>" >
                <div class="flex justify-end pt-3"><span class="underline cursor-pointer text-deeppurple400 hover:text-deeppurple600" ><?= ($locale->forgot) ?></span></div>
            </div>            
        </div>
        <div class="flex flex-row h-12 items-center justify-end pr-3" >            
            <button type="submit" class="outline-none mb-1 focus:border-bluegray700 active:border-gray900 hover:border-gray600 border-gray400 border border-solid  pb-2 pt-2 pl-4 pr-4 text-center text-bluegray900 rounded font-ligh cursor-pointer" ><?php if (isset($locale->btnsubmit)): ?><?= ($locale->btnsubmit) ?><?php else: ?>Undefined<?php endif; ?></button>
        </div>
    </form>
</div>