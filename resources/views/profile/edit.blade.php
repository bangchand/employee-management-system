@extends('dashboard.layouts.main')


@section('content')
    <div class="container-fluid">
        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <img src="{{ asset('dist/images/backgrounds/profilebg.jpg') }}" alt="" class="img-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="d-flex align-items-center justify-content-around m-4">
                            <div class="text-center">
                                <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">{{ $projects }}</h4>
                                <p class="mb-0 fs-4">Proyek</p>
                            </div>
                            <div class="text-center">
                                <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1">{{ $employees }}</h4>
                                <p class="mb-0 fs-4">Karyawan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 110px; height: 110px;";>
                                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                                        style="width: 100px; height: 100px;";>
                                        <img src="{{ asset('dist/images/profile/user-4.jpg') }}" alt=""
                                            class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h5 class="fs-5 mb-0 fw-semibold">{{ $user->name }}</h5>
                                <p class="mb-0 fs-4">{{ Auth::user()->getRoleNames()->implode(',') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-last">

                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                            role="tab" aria-controls="pills-profile" aria-selected="true">
                            <i class="ti ti-user-circle me-2 fs-6"></i>
                            <span class="d-none d-md-block">Profile</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
                            id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button"
                            role="tab" aria-controls="pills-followers" aria-selected="false">
                            <i class="ti ti-settings me-2 fs-6"></i>
                            <span class="d-none d-md-block">Pengaturan</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-none border">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-3">Perusahaan</h4>
                                <p>Hello, I am {{ $user->name }}. I love making websites and graphics.</p>
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-briefcase text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">Sir, {{ $user->name }}</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-building text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">{{ $user->company->name }}</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-4">
                                        <i class="ti ti-mail text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">{{ $user->company->contact_email }}</h6>
                                    </li>
                                    <li class="d-flex align-items-center gap-3 mb-2">
                                        <i class="ti ti-map-pin text-dark fs-6"></i>
                                        <h6 class="fs-4 fw-semibold mb-0">{{ $user->company->address }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card border">
                            <div class="px-4 py-3 border-bottom">
                                <h5 class="card-title fw-semibold mb-0">Edit Profil Pribadi</h5>
                            </div>
                            <form action="{{ route('profile.update') }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Nama</label>
                                        <div class="input-group border rounded-1">
                                            <span class="input-group-text bg-transparent px-6 border-0" id="basic-addon1"><i
                                                    class="ti ti-user fs-6"></i></span>
                                            <input type="text" class="form-control border-0 ps-2" name="name"
                                                value="{{ $user->name }}" placeholder="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label fw-semibold">Email</label>
                                        <div class="input-group border rounded-1">
                                            <span class="input-group-text bg-transparent px-6 border-0"
                                                id="basic-addon1"><i class="ti ti-mail fs-6"></i></span>
                                            <input type="text" class="form-control border-0 ps-2" name="email"
                                                value="{{ $user->email }}" placeholder="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab"
                tabindex="0">
                <div class="col-xl-12 col-xxl-12">
                    <div class="row">
                        <!-- Atur Lokasi Perusahaan -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Atur Lokasi Perusahaan Anda!</h5>
                                    <form action="{{ route('company.location.update', ['route' => 'profile.edit']) }}"
                                        method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="mb-3">
                                            {{-- Input untuk lokasi dan tombol pencarian --}}
                                            <div class="input-group mb-3">
                                                <input type="text" id="location-search" class="form-control"
                                                    placeholder="Cari Lokasi">
                                                <button id="search-button" class="btn btn-primary"
                                                    type="button">Cari</button>
                                            </div>

                                            {{-- Peta --}}
                                            <div id="map" class="border rounded" style="height: 300px;"></div>

                                            {{-- Input untuk latitude dan longitude --}}
                                            <div class="mt-3">
                                                <input type="hidden" id="latitude" class="form-control mb-2"
                                                    name="latitude" placeholder="Lintang">
                                                <input type="hidden" id="longitude" class="form-control"
                                                    name="longitude" placeholder="Bujur">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Atur Jam Kantor</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('update.officeHour') }}" method="POST">
                                        @csrf
                                        @method('patch')
                                        <!-- Jam Masuk -->
                                        <label for="checkin_start" class="form-label">Jam Masuk:</label>
                                        <div class="d-flex">
                                            <input type="time" class="form-control" id="checkin_start"
                                                name="checkin_start" value="{{ $user->company->checkin_start }}">
                                            <h2 class="ms-2">-</h2>
                                            <input type="time" class="form-control ms-2" id="checkin_end"
                                                name="checkin_end" value="{{ $user->company->checkin_end }}">
                                        </div>

                                        <!-- Menit Toleransi Masuk -->
                                        <label for="checkin_tolerance" class="form-label mt-3">Menit Toleransi
                                            Masuk:</label>
                                        <input type="number" class="form-control" id="checkin_tolerance"
                                            name="checkin_tolerance" value="{{ $user->company->checkin_tolerance }}"
                                            min="0">

                                        <!-- Jam Keluar -->
                                        <label for="checkout_start" class="form-label mt-3">Jam Keluar:</label>
                                        <div class="d-flex">
                                            <input type="time" class="form-control" id="checkout_start"
                                                name="checkout_start" value="{{ $user->company->checkout_start }}">
                                            <h2 class="ms-2">-</h2>
                                            <input type="time" class="form-control ms-2" id="checkout_end"
                                                name="checkout_end" value="{{ $user->company->checkout_end }}">
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        var map = L.map('map').setView([-7.8965894, 112.6090665], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: ''
        }).addTo(map);

        var marker = null;

        function updateMarker(lat, lng, address = '') {
            if (!marker) {
                marker = L.marker([lat, lng]).addTo(map);
            } else {
                marker.setLatLng([lat, lng]);
            }

            map.setView([lat, lng], 15);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            marker.bindPopup(address).openPopup();
        }

        document.getElementById('search-button').addEventListener('click', function() {
            var location = document.getElementById('location-search').value;

            if (location) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${location}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lng = data[0].lon;
                            var displayName = data[0].display_name;
                            updateMarker(lat, lng, displayName);
                        } else {
                            alert('Location not found.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    var displayName = data.display_name;
                    updateMarker(lat, lng, displayName);
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
