<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Metronic | Empty Page</title>
    <meta name="description" content="Page with empty content">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js')}}"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Fonts -->

    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Page Vendors Styles -->

    <!--begin:: Global Mandatory Vendors -->
    <link href="{{ asset('assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{ asset('assets/vendors/general/tether/dist/css/tether.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/select2/dist/css/select2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/nouislider/distribute/nouislider.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/animate.css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/socicon/css/socicon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon2/flaticon.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/fontawesome5/css/all.min.css')}}" rel="stylesheet" type="text/css" />

    <!--end:: Global Optional Vendors -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.css">
    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="{{ asset('assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/demo/default/skins/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/default/skins/header/menu/light.css?v=1.2')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/default/skins/brand/dark.css?v=1.2')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/demo/default/skins/aside/dark.css?v=1.5')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/demo/default/skins/aside/saude.css?v=1.11')}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico')}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="index.html">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo_saude_sf.png')}}" />
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Aside -->
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

            <!-- begin:: Aside -->
            <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
                <div class="kt-aside__brand-logo">
                    <a href="index.html">
                        <img alt="Logo" src="{{ asset('assets/media/logos/logo_saude_mais.png')}}" />
                    </a>
                </div>
                <div class="kt-aside__brand-tools">
                    <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
											<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
										</g>
									</svg></span>
                        <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon id="Shape" points="0 0 24 0 24 24 0 24" />
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" id="Path-94" fill="#000000" fill-rule="nonzero" />
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
										</g>
									</svg></span>
                    </button>

                    <!--
    <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
    -->
                </div>
            </div>










            <!-- end:: Aside -->

            <!-- begin:: Aside Menu -->
            <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
                <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
                    <ul class="kt-menu__nav ">
                        <li class="kt-menu__item " aria-haspopup="true"><a href="index.html" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-home"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
                        <li class="kt-menu__section ">
                            <h4 class="kt-menu__section-text">Layout</h4>
                            <i class="kt-menu__section-icon flaticon-more-v2"></i>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu {{ ativadorLinks(
                        [
                            'apolice.*',
                            'seguradora.*',
                            'empresa.*',
                            'especialidade.*',
                            'cobertura.*',
                            'plano.*',
                            'medico.*',
                            'cid.*',
                            'banco.*'
                        ]) }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-layers"></i><span class="kt-menu__link-text">Cadastros</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Subheaders</span></span></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['apolice.*']) }}" aria-haspopup="true"><a href="{{ route('apolice.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Apolice</span></a></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['usuario.*']) }}" aria-haspopup="true"><a href="{{ route('usuario.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Usuario</span></a></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['seguradora.*']) }}" aria-haspopup="true"><a href="{{ route('seguradora.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Seguradora</span></a></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['empresa.*']) }}" aria-haspopup="true"><a href="{{ route('empresa.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Empresa</span></a></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['especialidade.*']) }}" aria-haspopup="true"><a href="{{ route('especialidade.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Especialidade</span></a></li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['plano.*']) }}" aria-haspopup="true">
                                        <a href="{{ route('plano.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Planos</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['medico.*']) }}" aria-haspopup="true">
                                        <a href="{{ route('medico.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Medico</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['cid.*']) }}" aria-haspopup="true">
                                        <a href="{{ route('cid.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">CID</span>
                                        </a>
                                    </li>
                                    <li class="kt-menu__item {{ ativadorSubLinks(['banco.*']) }}" aria-haspopup="true">
                                        <a href="{{ route('banco.index') }}" class="kt-menu__link ">
                                            <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
                                            <span class="kt-menu__link-text">Banco</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                            <li class="kt-menu__section ">
                                <h4 class="kt-menu__section-text">Administrativo</h4>
                                <i class="kt-menu__section-icon flaticon-more-v2"></i>
                            </li>

                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-light"></i><span class="kt-menu__link-text">Relatorios</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Relatorio</span></span></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('apolice.relatorio') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Apolice</span></a></li>

                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-open-box"></i><span class="kt-menu__link-text">Icons</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_icons_flaticon.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Flaticon</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_icons_fontawesome5.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Fontawesome 5</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_icons_lineawesome.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lineawesome</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_icons_socicons.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Socicons</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_icons_svg.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">SVG Icons</span></a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-interface-1"></i><span class="kt-menu__link-text">Portlets</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                            <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                <ul class="kt-menu__subnav">
                                    <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Portlets</span></span></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_base.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Base Portlets</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_advanced.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Advanced Portlets</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_tabbed.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Tabbed Portlets</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_draggable.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Draggable Portlets</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_tools.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Portlet Tools</span></a></li>
                                    <li class="kt-menu__item " aria-haspopup="true"><a href="components_portlets_sticky-head.html" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Sticky Head</span></a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- end:: Aside Menu -->
        </div>















        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <!-- MENU DIREITA ENCIMA -->
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>
                <div class="kt-header__topbar">
                    <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="Quick panel" data-placement="right">
								<span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect id="bound" x="0" y="0" width="24" height="24" />
											<rect id="Rectangle-7" fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
											<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" id="Combined-Shape" fill="#000000" opacity="0.3" />
										</g>
									</svg> </span>
                    </div>
                    <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
									<span class="kt-header__topbar-icon">
										<img class="" src="{{ asset('assets/media/flags/020-flag.svg')}}" alt="" />
									</span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">
                            <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                                <li class="kt-nav__item kt-nav__item--active">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-icon"><img src="{{ asset('assets/media/flags/020-flag.svg')}}" alt="" /></span>
                                        <span class="kt-nav__link-text">English</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-icon"><img src="{{ asset('assets/media/flags/016-spain.svg')}}" alt="" /></span>
                                        <span class="kt-nav__link-text">Spanish</span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                        <span class="kt-nav__link-icon"><img src="{{ asset('assets/media/flags/017-germany.svg')}}" alt="" /></span>
                                        <span class="kt-nav__link-text">German</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                                <span class="kt-header__topbar-username kt-hidden-mobile">Sean</span>
                                <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg')}}" />

                                <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">S</span>
                            </div>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('assets/media/misc/bg-1.jpg')}}">
                                <div class="kt-user-card__avatar">
                                    <img class="kt-hidden" alt="Pic" src="{{ asset('assets/media/users/300_25.jpg')}}" />

                                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">S</span>
                                </div>
                                <div class="kt-user-card__name">
                                    Sean Stone
                                </div>
                                <div class="kt-user-card__badge">
                                    <span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
                                </div>
                            </div>

                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                                <a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Profile
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Account settings and more
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-mail kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Messages
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Inbox and tasks
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-rocket-1 kt-font-danger"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Activities
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Logs and notifications
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-hourglass kt-font-brand"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            My Tasks
                                        </div>
                                        <div class="kt-notification__item-time">
                                            latest tasks and projects
                                        </div>
                                    </div>
                                </a>
                                <div class="kt-notification__custom">
                                    <a href="custom_user_login-v2.html" target="_blank" class="btn btn-label-brand btn-sm btn-bold">Sign Out</a>
                                </div>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- MENU DIREITA ENCIMA -->





            <!-- CONTEUDO -->
            @yield('conteudo')
            <!-- CONTEUDO -->






            <!-- begin:: Footer -->
            <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
                <div class="kt-footer__copyright">
                    2019&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
                </div>
                <div class="kt-footer__menu">
                    <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
                    <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
                    <a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
                </div>
            </div>

            <!-- end:: Footer -->
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Quick Panel -->
<div id="kt_quick_panel" class="kt-quick-panel">
    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
    <div class="kt-quick-panel__nav">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
            <li class="nav-item active">
                <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Notifications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_logs" role="tab">Audit Logs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_tab_settings" role="tab">Settings</a>
            </li>
        </ul>
    </div>
    <div class="kt-quick-panel__content">
        <div class="tab-content">
            <div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
                <div class="kt-notification">
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-line-chart kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New order has been received
                            </div>
                            <div class="kt-notification__item-time">
                                2 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-box-1 kt-font-brand"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New customer is registered
                            </div>
                            <div class="kt-notification__item-time">
                                3 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-chart2 kt-font-danger"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Application has been approved
                            </div>
                            <div class="kt-notification__item-time">
                                3 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-image-file kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New file has been uploaded
                            </div>
                            <div class="kt-notification__item-time">
                                5 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-bar-chart kt-font-info"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New user feedback received
                            </div>
                            <div class="kt-notification__item-time">
                                8 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-pie-chart-2 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                System reboot has been successfully completed
                            </div>
                            <div class="kt-notification__item-time">
                                12 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-favourite kt-font-danger"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New order has been placed
                            </div>
                            <div class="kt-notification__item-time">
                                15 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item kt-notification__item--read">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-safe kt-font-primary"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Company meeting canceled
                            </div>
                            <div class="kt-notification__item-time">
                                19 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-psd kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New report has been received
                            </div>
                            <div class="kt-notification__item-time">
                                23 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon-download-1 kt-font-danger"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                Finance report has been generated
                            </div>
                            <div class="kt-notification__item-time">
                                25 hrs ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon-security kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New customer comment recieved
                            </div>
                            <div class="kt-notification__item-time">
                                2 days ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification__item">
                        <div class="kt-notification__item-icon">
                            <i class="flaticon2-pie-chart kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title">
                                New customer is registered
                            </div>
                            <div class="kt-notification__item-time">
                                3 days ago
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tab-pane fade kt-scroll" id="kt_quick_panel_tab_logs" role="tabpanel">
                <div class="kt-notification-v2">
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon-bell kt-font-brand"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                5 new user generated report
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Reports based on sales
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-box kt-font-danger"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                2 new items submited
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                by Grog John
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon-psd kt-font-brand"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                79 PSD files generated
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Reports based on sales
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-supermarket kt-font-warning"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                $2900 worth producucts sold
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Total 234 items
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon-paper-plane-1 kt-font-success"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                4.5h-avarage response time
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Fostest is Barry
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-information kt-font-danger"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                Database server is down
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                10 mins ago
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-mail-1 kt-font-brand"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                System report has been generated
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Fostest is Barry
                            </div>
                        </div>
                    </a>
                    <a href="#" class="kt-notification-v2__item">
                        <div class="kt-notification-v2__item-icon">
                            <i class="flaticon2-hangouts-logo kt-font-warning"></i>
                        </div>
                        <div class="kt-notification-v2__itek-wrapper">
                            <div class="kt-notification-v2__item-title">
                                4.5h-avarage response time
                            </div>
                            <div class="kt-notification-v2__item-desc">
                                Fostest is Barry
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="tab-pane kt-quick-panel__content-padding-x fade kt-scroll" id="kt_quick_panel_tab_settings" role="tabpanel">
                <form class="kt-form">
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Customer Care</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Notifications:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_1">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Case Tracking:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" name="quick_panel_notifications_2">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Support Portal:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--success kt-switch--sm">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_2">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Reports</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Generate Reports:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_3">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Report Export:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" name="quick_panel_notifications_3">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Allow Data Collection:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--danger">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_4">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--space-md kt-separator--border-dashed"></div>
                    <div class="kt-heading kt-heading--sm kt-heading--space-sm">Memebers</div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Enable Member singup:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_5">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-xs row">
                        <label class="col-8 col-form-label">Allow User Feedbacks:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" name="quick_panel_notifications_5">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                    <div class="form-group form-group-last form-group-xs row">
                        <label class="col-8 col-form-label">Enable Customer Portal:</label>
                        <div class="col-4 kt-align-right">
									<span class="kt-switch kt-switch--sm kt-switch--brand">
										<label>
											<input type="checkbox" checked="checked" name="quick_panel_notifications_6">
											<span></span>
										</label>
									</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- end::Quick Panel -->

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>



<div id="kt_demo_panel" class="kt-demo-panel">
    <div class="kt-demo-panel__head">
        <h3 class="kt-demo-panel__title">
            Select A Demo

            <!--<small>5</small>-->
        </h3>
        <a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close"><i class="flaticon2-delete"></i></a>
    </div>
    <div class="kt-demo-panel__body">
        <div class="kt-demo-panel__item kt-demo-panel__item--active">
            <div class="kt-demo-panel__item-title">
                Default
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-_Default.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 2
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-2.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 3
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-3.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 4
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-4.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 5
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-5.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 6
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-6.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 7
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-7.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 8
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-8.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 9
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-9.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 10
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-10.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 11
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-11.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 12
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-12.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate " target="_blank">Preview</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 13
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-13.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
                </div>
            </div>
        </div>
        <div class="kt-demo-panel__item ">
            <div class="kt-demo-panel__item-title">
                Demo 14
            </div>
            <div class="kt-demo-panel__item-preview">
                <img src="{{ asset('assets/media/demos/Demo-14.jpg')}}" alt="" />
                <div class="kt-demo-panel__item-preview-overlay">
                    <a href="#" class="btn btn-brand btn-elevate disabled">Coming soon</a>
                </div>
            </div>
        </div>
        <a href="" target="_blank" class="kt-demo-panel__purchase btn btn-brand btn-elevate btn-bold btn-upper">
            Buy Metronic Now!
        </a>
    </div>
</div>

<!-- end::Demo Panel -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/popper.js/dist/umd/popper.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/js-cookie/src/js.cookie.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/moment/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/sticky-js/dist/sticky.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/wnumb/wNumb.js')}}" type="text/javascript"></script>

<!--end:: Global Mandatory Vendors -->

<!--begin:: Global Optional Vendors -->
<script src="{{ asset('assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/bootstrap-datepicker/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/bootstrap-timepicker/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/bootstrap-switch/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/nouislider/distribute/nouislider.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/owl.carousel/dist/owl.carousel.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/autosize/dist/autosize.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/clipboard/dist/clipboard.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/dropzone/dist/dropzone.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/markdown/lib/markdown.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/bootstrap-markdown/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/bootstrap-notify/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/jquery-validation/dist/jquery.validate.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/jquery-validation/dist/additional-methods.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/jquery-validation/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/toastr/build/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/raphael/raphael.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/morris.js/morris.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/waypoints/lib/jquery.waypoints.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/counterup/jquery.counterup.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/es6-promise-polyfill/promise.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/sweetalert2/dist/sweetalert2.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/components/vendors/sweetalert2/init.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/general/dompurify/dist/purify.js')}}" type="text/javascript"></script>

<!--end:: Global Optional Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/custom/gmaps/gmaps.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('assets/app/custom/general/dashboard.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->

<!--begin::Global App Bundle(used by all pages) -->
<script src="{{ asset('assets/app/bundle/app.bundle.js')}}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.2/dist/bootstrap-table.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.18.3/bootstrap-table-locale-all.min.js"></script>


@yield('scripts')

<script>



    $('.table-contato').bootstrapTable({
        locale: 'pt-BR',
        // Outras configurações da tabela
    });

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "600",
        "hideDuration": "5000",
        "timeOut": "10000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Exibir mensagens da sessão
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif

    // Exibir mensagens de erro de validação
    @if ($errors->any())
    @php
        $errorMessages = '';
    @endphp

    @foreach ($errors->all() as $error)
        @php
            $errorMessages .= $error . '<br>';
        @endphp
    @endforeach

    toastr.error("{!! $errorMessages !!}");
@endif
</script>


<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>
