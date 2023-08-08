@extends('master.admin.app')

@push('plugin-styles')
  <link href="{{ asset('assets/admin/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Master</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.doctors.index') }}">{{ $breadcrumb }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit {{ $breadcrumb }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header flex flex-align-center">
                <h6 class="card-title flex-full-width mb-0">Edit {{ $breadcrumb }}</h6>
                <a href="{{ route('admin.doctors.index') }}" type="button" class="btn btn-sm btn-secondary btn-icon-text">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {{ session()->get('error') }}
                    </div>
                    @php
                        Session::forget('error');
                    @endphp
                @endif
                <form action="{{ route('admin.doctors.update', Crypt::encryptString($data->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Doctor Name <span class="text-danger">*</span></label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Insert doctor name here.." value="{{ old('name') ?? $data->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Specialist <span class="text-danger">*</span></label>
                                <select name="specialist" class="js-example-basic-single form-select @error('specialist') is-invalid @enderror" data-width="100%">
                                    <option selected disabled>-- Choose Specialist --</option>
                                    @foreach ($specialists as $item)
                                        <option value="{{ $item->id }}"{{ old('specialist', $data->specialist_id) == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('specialist')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Sub Specialist</label>
                                <select name="sub_specialist" class="js-example-basic-single form-select @error('sub_specialist') is-invalid @enderror" data-width="100%">
                                    <option selected disabled>-- Choose Sub Specialist --</option>
                                    @foreach ($subSpecialists as $item)
                                        <option value="{{ $item->id }}"{{ old('sub_specialist', $data->sub_specialist_id) == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('sub_specialist')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2" placeholder="Insert keterangan here..">{{ old('keterangan') ?? $data->keterangan }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <input name="notes" type="text" class="form-control @error('notes') is-invalid @enderror"
                                    value="{{ old('notes') ?? $data->notes }}">
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Site <span class="text-danger">*</span></label>
                                <select name="site" class="js-example-basic-single form-select @error('site') is-invalid @enderror" data-width="100%">
                                    <option selected disabled>-- Choose Site --</option>
                                    @foreach ($sites as $item)
                                        <option value="{{ $item->id }}"{{ old('site', $data->site_id) == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('site')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="js-example-basic-single form-select @error('status') is-invalid @enderror" data-width="100%">
                                    <option value="1"{{ old('status', $data->isAktif) == '1' ? 'selected' : null }}>Aktif</option>
                                    <option value="0"{{ old('status', $data->isAktif) == '0' ? 'selected' : null }}>Non Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Foto Dokter <span class="text-danger">*</span></h6>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <input name="picture" type="file" class="form-control @error('picture') is-invalid @enderror" accept="image/*" 
                                    value="{{ old('picture') }}" onchange="previewImages()">
                                @error('picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if ($data->picture != null)
                            <div id="preview">
                                <img src="{{ $data->takeImage }}" height="200" alt="Preview Gambar">
                            </div>
                        @endif
                        <div id="preview"></div>
                    </div>
                    <hr>

                    <div class="text-end">
                        <button name="btnSimpan" class="btn btn-primary" type="submit">{{ $btnSubmit }}</button>
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/admin/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/admin/js/select2.js') }}"></script>
<script type="text/javascript">
    //Preview Image
    function previewImages() {
        var preview = document.querySelector('#preview');
        preview.innerHTML = '';
        var files = document.querySelector('input[type=file]').files;
    
        function readAndPreview(file) {
            // Make sure `file.name` matches our extensions criteria
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                var reader = new FileReader();
                reader.addEventListener('load', function() {
                    var image = new Image();
                    image.height = 150;
                    image.title = file.name;
                    image.src = this.result;
                    preview.appendChild(image);
                }, false);
    
                reader.readAsDataURL(file);
            }
        }
    
        if (files) {
            [].forEach.call(files, readAndPreview);
        }
    }

    //Toast for session success
    const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if (session('success')) {
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}",
            });
        }
        @endif
</script>
@endpush