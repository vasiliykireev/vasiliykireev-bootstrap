<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<footer class="footer container-fluid bg-dark py-5" data-bs-theme="dark">
        <div class="row align-items-center">
            <div class="col-12 col-xl-6 mb-2">
                <div class="about ms-2 mb-2">
                    <div class="about__logo mb-1 text-light fw-semibold">Василий Квасов</div>
                    <div class="about__caption text-body-secondary">Я делаю сайты, IT-проекты и все, чтобы они хорошо работали.</div>
                </div>
            </div>
            <div class="footer-menu col-12 col-xl-6 mb-2">
                <?$APPLICATION->IncludeComponent(
                    	"bitrix:menu", 
                    	"footer-menu", 
                    	array(
                    		"ROOT_MENU_TYPE" => "top",
                    		"MAX_LEVEL" => "3",
                    		"CHILD_MENU_TYPE" => "left",
                    		"USE_EXT" => "Y",
                    		"COMPONENT_TEMPLATE" => "top_menu",
                    		"MENU_CACHE_TYPE" => "N",
                    		"MENU_CACHE_TIME" => "3600",
                    		"MENU_CACHE_USE_GROUPS" => "Y",
                    		"MENU_CACHE_GET_VARS" => array(
                    		),
                    		"DELAY" => "N",
                    		"ALLOW_MULTI_SELECT" => "N"
                    	),
                    	false
                );?>
            </div>
        </div>
        <div class="links row">
            <div class="col-12 col-md-6 mb-2">
                <div class="contacts">
                    <?$APPLICATION->IncludeComponent(
                    	"bitrix:menu", 
                    	"footer-contact", 
                    	array(
                    		"ROOT_MENU_TYPE" => "contact",
                    		"MAX_LEVEL" => "3",
                    		"CHILD_MENU_TYPE" => "left",
                    		"USE_EXT" => "Y",
                    		"COMPONENT_TEMPLATE" => "footer-contact",
                    		"MENU_CACHE_TYPE" => "N",
                    		"MENU_CACHE_TIME" => "3600",
                    		"MENU_CACHE_USE_GROUPS" => "Y",
                    		"MENU_CACHE_GET_VARS" => array(
                    		),
                    		"DELAY" => "N",
                    		"ALLOW_MULTI_SELECT" => "N"
                    	),
                    	false
                    );?>
                    <!-- <ul class="contacts__list ps-0 mb-0">
                        <li class="contacts__item contacts__item_link_mailto">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark pt-0 pb-1 px-2" aria-current="page" href="mailto:hello@vasiliykvasov.ru">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/></svg>
                            <span class="lh-1 align-middle">hello@vasiliykvasov.ru</span>
                            </a>
                        </li>
                    </ul> -->
                </div>
                <div class="social">
                    <?$APPLICATION->IncludeComponent(
                	"bitrix:menu", 
                	"footer-social", 
                	array(
                		"ROOT_MENU_TYPE" => "social",
                		"MAX_LEVEL" => "3",
                		"CHILD_MENU_TYPE" => "left",
                		"USE_EXT" => "Y",
                		"COMPONENT_TEMPLATE" => "footer-social",
                		"MENU_CACHE_TYPE" => "N",
                		"MENU_CACHE_TIME" => "3600",
                		"MENU_CACHE_USE_GROUPS" => "Y",
                		"MENU_CACHE_GET_VARS" => array(
                		),
                		"DELAY" => "N",
                		"ALLOW_MULTI_SELECT" => "N"
                	),
                	false
                );?>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous" defer></script>
</body>
</html>