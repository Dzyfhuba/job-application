<x-app-layout>
    <div class="t-max-w-sm t-mx-auto t-py-10">
        <img src="/images/energeek.png" alt="" class="t-mx-auto t-mb-5">

        <form class="t-card t-shadow-md t-bg-base-100 t-p-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" placeholder="Cth: Jhonatan Akbar" required>
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Jabatan</label>
                <select name="job" id="job" class="form-control" required>
                </select>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon</label>
                <input type="tel" class="form-control" id="phone" placeholder="Cth: 0893239851289" maxlength="9999999999999" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Cth: energeekmail@gmail.com" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Tahun Lahir</label>
                <input type="number" class="form-control" id="year" placeholder="Cth: 1997" required>
            </div>
            <div class="mb-3">
                <label for="skill_sets" class="form-label">Skill Set</label>
                <select name="skill_sets[" id="skill_sets" class="form-control" multiple="multiple" required></select>
            </div>

            <button type="submit" class="t-btn t-btn-primary">Apply</button>
        </form>
    </div>

    <x-slot name="style">
        <style>
            .select2-container .select2-selection--single {
                height: 38px !important;
            }

            .select2-search__field {
                height: 28px !important;
            }

            .select2-selection__choice__display {
                color: #000;
                font-size: smaller;
            }

            .select2-container .select2-selection--multiple {
                min-height: 38px !important;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 38px !important;
            }
        </style>
    </x-slot>

    <x-slot name="script">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="/plugins/inputmask/dist/jquery.inputmask.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            document.querySelector('body').classList.add('t-bg-base-200')
            $('#job').select2({
                placeholder: 'Pilih Jabatan',
                ajax: {
                    url: '/api/select/jobs',
                },
            })
            $('#skill_sets').select2({
                placeholder: 'Pilih Skill',
                ajax: {
                    url: '/api/select/skills',
                },
            })

            document.querySelector('form').addEventListener('submit', (e) => {
                e.preventDefault()

                const data = {
                    name: document.querySelector('#name').value,
                    job_id: document.querySelector('#job').value,
                    phone: document.querySelector('#phone').value,
                    email: document.querySelector('#email').value,
                    year: document.querySelector('#year').value,
                    skill_sets_id: $('#skill_sets').select2('data').map(a => a.id),
                }

                const TOKEN = document.querySelector('[name="csrf-token"]').getAttribute('content')

                axios.post('/api/application', data)
                    .then(res => {
                        console.log(res.data)
                        Swal.fire({
                                title: 'Berhasil',
                                text: 'Lamaran berhasil dikirim.',
                                icon: 'success',
                                confirmButtonText: 'Selesai',
                                confirmButtonColor: '#1BC5BD',
                            })
                            .then(() => {
                                e.target.reset()
                                $('#job').val(null).trigger('change');
                                $('#skill_sets').val(null).trigger('change');
                            })
                    })
                    .catch(err => {
                        const error = err.response.data.error
                        const keys = Object.keys(error)
                        let message = ''
                        for (const key in error) {
                            message += error[key] + '<br />'
                        }
                        Swal.fire({
                            title: 'Terjadi Kesalahan',
                            html: message,
                            icon: 'warning',
                            confirmButtonText: 'Selesai',
                            confirmButtonColor: '#F64E60'
                        })
                    })
            })
        </script>
    </x-slot>
</x-app-layout>