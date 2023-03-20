<x-web-layout title="My Profile">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row g-5 g-xxl-8">
                <div class="col-xl-12">
                    <div class="card mb-5 mb-xxl-8">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{asset('img/avatars/admin.png')}}" alt="image" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{Auth::user()->name}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5 g-xxl-8">
                <div class="col-xl-12">
                    <div class="card mb-5 mb-xxl-8">
                        <form id="form-profile">
                            <div class="card-body pb-0">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="username">Password Baru</label>
                                        <input class="form-control" type="password" name="password_baru" id="password_baru">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="username">Konfirmasi Password Baru</label>
                                        <input class="form-control" type="password" name="kpassword_baru" id="kpassword_baru">
                                    </div>
                                </div>
                                <div class="min-w-150px mt-10 text-end">
                                    <button class="btn btn-primary" id="tombol_simpan" onclick="handle_save_password('#tombol_simpan','#form-profile','{{route('web.profile.cpassword')}}','POST');">Kirim</button>
                                </div>
                            </div>
                        </form>
                            <form id="kt_forms_widget_1_form" class="ql-quil ql-quil-plain pb-3">
                                <div id="kt_forms_widget_1_editor" class="py-6"></div>
                                <div class="separator"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>