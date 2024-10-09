<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
</main>
<footer class="footer container-fluid bg-dark mt-auto py-5" data-bs-theme="dark">
        <div class="row align-items-center">
            <div class="col-12 col-xl-6 mb-2">
			    <div class="about ms-2 mb-2 text-light">
                <? // About 
                $APPLICATION->IncludeComponent(
                	"bitrix:main.include", 
                	".default", 
                	array(
                		"AREA_FILE_SHOW" => "file",
                		"AREA_FILE_SUFFIX" => "brand",
                		"AREA_FILE_RECURSIVE" => "Y",
                		"EDIT_TEMPLATE" => "sect_footer.php",
                		"COMPONENT_TEMPLATE" => ".default",
                		"PATH" => "/include/sect_footer.php"
                	),
                	false
                );?>
			    </div>
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
</body>
</html>