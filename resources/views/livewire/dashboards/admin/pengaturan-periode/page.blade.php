<div>
    <section class="d-flex justify-content-center row connectedSortable ui-sortable">
        {{-- start card-list-periode --}}
        <div class="card card-info" id="tabel-periode">
            <div class="card-header">
                <h4>Pengaturan Periode dan Template Inputan</h4>
            </div>
            <div class="card-body px-3 py-3">
                    <div class="mb-3 card collapse bg-gradient-secondary fade show active" id="collapse-list-periode-info">
                        <div class="card-body">
                          <div class="card-tools">
                              <button type="button" class="close" data-toggle="collapse"
                                  data-target="#collapse-list-periode-info" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                            <div>
                                Dibawah ini merupakan kendali untuk mengatur periode input.<br>
                                Pada kendali ini, dapat diatur : <br>
                                <ul class="mt-2">
                                  <li>
                                    Tanggal awal dan akhir periode input 
                                  </li>
                                  <li>
                                    Pesan Berjalan pada Dashboard
                                  </li>
                                  <li>
                                    Template inputan / Apa saja yang akan di input oleh tiap-tiap tipe pegawai pada periode tersebut
                                  </li>
                                </ul>
                                Periode inputan akan berjalan secara otomatis ketika sudah masuk tanggal awal jika periode di aktifkan.<br>
                            </div>
                        </div>
                      </div>

                @if (session()->has('card_list_periode_success'))
                    <div class="alert alert-success alert-dismissable fade show" role="alert">
                        {{session('card_list_periode_success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('card_list_periode_danger'))
                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                        {{session('card_list_periode_danger')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div wire:loading>
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <small> Memuat data . . .</small>
                    </div>
                @livewire('dashboards.admin.pengaturan-periode.tabel-list-periode')
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary" wire:click='$emit("buatPeriodeBaru")'>Buat Periode Baru</button>
            </div>
        </div>
        
        <div class="col-sm-12 collapse fade" id="form-periode" wire:ignore.self>
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="close" data-toggle="collapse"
                            data-target="#form-periode" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @livewire('dashboards.admin.pengaturan-periode.form-periode')
                </div>
            </div>
        </div>

        <div class="col-sm-12 collapse fade" id="tabel-template" wire:ignore.self>
            @livewire('dashboards.admin.pengaturan-periode.form-tabel-template')
        </div>

        <div class="col-sm-12 collapse fade" id="form-buat-satu-template" wire:ignore.self>
            @livewire('dashboards.admin.pengaturan-periode.form-buat-satu-template')
        </div>

        <div class="col-sm-12 collapse fade" id="form-buat-banyak-template" wire:ignore.self>
            @livewire('dashboards.admin.pengaturan-periode.form-buat-banyak-template')
        </div>

        {{-- start modal ubah single template inputan apd --}}
            @livewire('dashboards.admin.pengaturan-periode.modal-ubah-satu-template')
        {{-- end modal ubah single template inputan apd --}}

        {{-- start modal ubah multi template inputan apd --}}
            @livewire('dashboards.admin.pengaturan-periode.modal-ubah-banyak-template')
        {{-- end modal ubah multi template inputan apd --}}

    </section>

{{-- start Tempat untuk javascript --}}
    @push('stack-body')
<div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
 
        {{-- untuk date picker --}}
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />

        <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
        <script>
            
            window.addEventListener('jsToast', event=>{
                $(document).Toasts('create', {
                class: event.detail.class,
                title: event.detail.title,
                subtitle: event.detail.subtitle,
                body: event.detail.body
                })
            })
            
        </script>
        
        <script>
            function keTabelInputanApd()
            {
                $("#form-periode").hide(500);  
                $("#tabel-template").collapse("show");
            }

            function keSingleTemplate()
            {
                $("#tabel-template").hide(500)
                $("#collapse-card-single-template-inputan-apd").collapse("show")
            }

            function keMultiTemplate()
            {
                $("#tabel-template").hide(500)
                $("#collapse-card-multi-template-inputan-apd").collapse("show")
            }

            function kembaliKeFormPeriode()
            {
                $("#form-periode").show(500);
                $("#tabel-template").collapse("hide");
            }

            function kembaliKeTabelInputanApdDariSingle()
            {
                $("#tabel-template").show(500)
                $("#collapse-card-single-template-inputan-apd").collapse("hide")
            }

            function kembaliKeTabelInputanApdDariMulti()
            {
                $("#tabel-template").show(500)
                $("#collapse-card-multi-template-inputan-apd").collapse("hide")
            }


            window.addEventListener("card_detail_periode_tampil", event=> {
                $("#form-periode").collapse('show')
            })

            window.addEventListener("card_tabel_inputan_tampil", event=> {
                keTabelInputanApd()
            })

            window.addEventListener("card_single_template_inputan_apd_tampil", event=> {
                keSingleTemplate()
            })

            window.addEventListener("card_multi_template_inputan_apd_tampil", event=> {
                keMultiTemplate()
            })

            window.addEventListener("tampilFormPeriode",event=>{
                $("#form-periode").collapse('show')
            })

            window.addEventListener("hideFormPeriode",event=>{
                $("#form-periode").collapse('hide')
            })

            window.addEventListener("tampilTabelTemplate",event=>{
                $("#tabel-template").collapse('show')
            })

            window.addEventListener("hideTabelTemplate",event=>{
                $("#tabel-template").collapse('hide')
            })
        </script>

<script>
    
    window.addEventListener('jsToast', event=>{
        $(document).Toasts('create', {
        class: event.detail.class,
        title: event.detail.title,
        subtitle: event.detail.subtitle,
        body: event.detail.body
        })
    })
    
</script>
    @endpush
{{-- end Tempat untuk javascript --}}

</div>
