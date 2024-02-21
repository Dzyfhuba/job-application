<x-app-layout>
    <div class="t-max-w-sm t-mx-auto t-pt-10">
        <img src="/images/energeek.png" alt="" class="t-mx-auto">

        <div class="t-card t-shadow-md t-bg-base-100 t-p-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" placeholder="Cth: Jhonatan Akbar">
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Nama Lengkap</label>
                <select name="job" id="job" class="form-control" style="height: 44px;">
                </select>
            </div>
        </div>
    </div>

    <x-slot name="style">
        <style>
            .select2-container .select2-selection--single {
                height: 38px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 38px !important;
            }
        </style>
    </x-slot>

    <x-slot name="script">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.querySelector('body').classList.add('t-bg-base-200')
            $('#job').select2({
                placeholder: 'Pilih Jabatan',
                height: 'resolve'
            })
        </script>
    </x-slot>
</x-app-layout>