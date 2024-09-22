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
                    <ul class="contacts__list ps-0 mb-0">
                        <li class="contacts__item contacts__item_link_mailto">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark pt-0 pb-1 px-2" aria-current="page" href="mailto:hello@vasiliykvasov.ru">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
                                </svg>
                            <span class="lh-1 align-middle">hello@vasiliykvasov.ru</span>
                            </a>
                        </li>
                    </ul>
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
                    <!-- <ul class="social__list ps-0 mb-0">
                        <li class="social__item social__item_link_github d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" aria-current="page" href="https://github.com/vasiliykireev/" target="_blank" title="Vasiliy Kvasov на GitHub">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/></svg>
                            </a>
                        </li>
                        <li class="social__item social__item_link_linkedin d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" aria-current="page" href="https://www.linkedin.com/in/vasiliy-kvasov-776387312/" target="_blank" title="Vasiliy Kvasov на LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/></svg>
                            </a>
                        </li>
                        <li class="social__item social__item_link_telegram d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" href="https://t.me/vasiliykvasovru" target="_blank" title="Канал в Telegram: Вася Квасов про интернет-дела">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-telegram" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"/></svg>
                            </a>
                        </li>
                        <li class="social__item social__item_link_x-twitter d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" href="https://x.com/vasyakvasov" target="_blank" title="Вася Квасов в X">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"><path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg>
                            </a>
                        </li>
                        <li class="social__item social__item_link_vk d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" href="https://vk.com/vasiliykvasovru" title="Василий Квасов во ВКонтакте">
                                <svg width="32" height="32" fill="currentColor" class="bi bi-vk" viewBox="0 0 448 512" version="1.1" id="svg1" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg"> <path d="m 4,36 c -36,36 -36,93.94286 -36,209.71429 v 20.57142 C -32,382.05714 -32,440 4,476 c 36,36 93.942857,36 209.71429,36 h 20.57142 C 350.05714,512 408,512 444,476 480,440 480,382.05714 480,266.28571 V 245.71429 C 480,129.94286 480,72 444,36 408,0 350.05714,0 234.28571,0 H 213.71429 C 97.942857,0 40,0 4,36 Z m 50.4,119.77143 h 58.4 c 1.94286,97.71428 45.02857,139.08571 79.2,147.54286 V 155.77143 h 55.08571 V 240 C 280.8,236.34286 316.11429,197.94286 328.11429,155.77143 H 383.2 C 378.62857,177.6 369.71429,198.4 356.8,216.68571 343.88571,234.97143 327.42857,250.4 308.22857,261.94286 c 21.37143,10.62857 40.22857,25.6 55.31429,44.11428 15.2,18.4 26.17143,39.77143 32.45714,62.74286 H 335.31429 C 329.82857,348.91429 318.4,330.97143 302.74286,317.48571 c -15.77143,-13.6 -35.08572,-22.17142 -55.65715,-24.8 V 368.8 h -6.62857 C 123.77143,368.8 57.142857,288.8 54.4,155.77143 Z" id="path1" style="stroke-width:1.14285" /></svg>
                            </a>
                        </li>
                        <li class="social__item social__item_link_dzen d-inline-block">
                            <a class="social__link btn btn-dark focus-ring focus-ring-dark py-2 px-2" href="https://dzen.ru/vasiliykvasovru" title="Василий Квасов на Дзен">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-dzen" viewBox="0 0 28 28"><path d="M16.7 16.7c-2.2 2.27-2.36 5.1-2.55 11.3 5.78 0 9.77-.02 11.83-2.02 2-2.06 2.02-6.24 2.02-11.83-6.2.2-9.03.35-11.3 2.55M0 14.15c0 5.59.02 9.77 2.02 11.83 2.06 2 6.05 2.02 11.83 2.02-.2-6.2-.35-9.03-2.55-11.3-2.27-2.2-5.1-2.36-11.3-2.55M13.85 0C8.08 0 4.08.02 2.02 2.02.02 4.08 0 8.26 0 13.85c6.2-.2 9.03-.35 11.3-2.55 2.2-2.27 2.36-5.1 2.55-11.3m2.85 11.3C14.5 9.03 14.34 6.2 14.15 0c5.78 0 9.77.02 11.83 2.02 2 2.06 2.02 6.24 2.02 11.83-6.2-.2-9.03-.35-11.3-2.55"></path>
                                </svg>
                            </a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous" defer></script>
</body>
</html>