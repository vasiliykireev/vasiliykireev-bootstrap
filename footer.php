<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<footer class="footer container-fluid bg-dark py-5" data-bs-theme="dark">
        <div class="row align-items-center">
            <div class="col-12 col-xl-6 mb-2">
                <? // About 
                $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                	"AREA_FILE_SHOW" => "sect",
                	"AREA_FILE_SUFFIX" => "footer",
                	"AREA_FILE_RECURSIVE" => "Y",
                	"EDIT_TEMPLATE" => "sect_footer.php"
                	),
                	false
                );?>
            </div>
            <div class="footer-menu col-12 col-xl-6 mb-2">
                <? // Footer Menu
                $APPLICATION->IncludeComponent(
                    	"bitrix:menu", 
                    	"footer-menu", 
                    	array(
                    		"ROOT_MENU_TYPE" => "top",
                    		"MAX_LEVEL" => "1",
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
                    <? // Footer Contacts
                    $APPLICATION->IncludeComponent(
                    	"bitrix:menu", 
                    	"footer-contact", 
                    	array(
                    		"ROOT_MENU_TYPE" => "contact",
                    		"MAX_LEVEL" => "1",
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
                </div>
                <div class="social">
                    <? // Footer Socials
                    $APPLICATION->IncludeComponent(
                	"bitrix:menu", 
                	"footer-social", 
                	array(
                		"ROOT_MENU_TYPE" => "social",
                		"MAX_LEVEL" => "1",
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