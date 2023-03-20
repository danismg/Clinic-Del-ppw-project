<div id="kt_header" style="" class="header align-items-stretch">
    <!--begin::Brand-->
    <div class="header-brand">
        <!--begin::Logo-->
        <a href="javascript:;">
            <img alt="Logo" src="{{ asset('img/favicon.png') }}" class="h-25px h-lg-25px" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside minimize-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr092.svg-->
            <span class="svg-icon svg-icon-1 me-n1 minimize-default">
                <i class="fas fa-angle-left"></i>
            </span>
            <!--end::Svg Icon-->
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
            <span class="svg-icon svg-icon-1 minimize-active">
                <i class="fas fa-angle-right"></i>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside minimize-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                            fill="black" />
                        <path opacity="0.3"
                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--end::Brand-->
    <div class="toolbar">
        <!--begin::Toolbar-->
        <div
            class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column me-5">
                <!--begin::Title-->
                <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">Dashboard</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Default</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <div class="d-flex align-items-center overflow-auto pt-3 pt-lg-0">
                <!--begin::Action wrapper-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <div class="d-flex">
                        <!--begin::Notifications-->
                        <div class="d-flex align-items-center">
                            <!--begin::Menu- wrapper-->
                            {{-- <a href="#" onclick="tombol_notif();"
                                class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary"
                                data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end" data-kt-menu-flip="bottom">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                <i class="fas fa-bell"></i>
                                <span id="top-notification-number" class="top-notification-number"></span>
                            </a> --}}
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px"
                                data-kt-menu="true">
                                <div class="d-flex flex-column bgi-no-repeat rounded-top"
                                    style="background-image:url('{{ asset('keenthemes/media/patterns/pattern-1.jpg') }}')">
                                    <h3 class="text-white fw-bold px-9 mt-10 mb-6">Notifications
                                        <span id="top-notification-number" class="top-notification-number"></span>
                                        <span>Reports</span>
                                    </h3>
                                </div>
                                <div class="navi navi-hover scroll-y mh-325px my-5 px-8" id="notification_items">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
