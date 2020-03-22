@extends('layout')

@push('styles')
    <link rel="stylesheet"
          href="https://pqina.github.io/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
@endpush

@section('navigation')
    <li class="breadcrumb-item">
        <a href="{{ route('images.index') }}">
            Správa obrázků
        </a>
    </li>
    <li class="breadcrumb-item active">Nahrát obrázky</li>
@endsection

@section('main')
    <h1 class="mt-5 mb-3">Nahrát obrázky</h1>
    <div class="row">
        <div class="col-sm-12">
            <input type="file" class="filepond" name="image" multiple>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://pqina.github.io/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script>
        // Register the plugin with FilePond
        FilePond.registerPlugin(
            FilePondPluginFileMetadata,
            FilePondPluginImageCrop,
            FilePondPluginImagePreview
        );

        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create the FilePond instance
        const pond = FilePond.create(inputElement, {
            imageCropAspectRatio: '1:1',
            fileMetadataObject: {
                'markup': [
                    [
                        'rect', {
                            left: 0,
                            right: 0,
                            bottom: 0,
                            height: '60px',
                            backgroundColor: 'rgba(0,0,0,.5)'
                        }
                    ]
                ]
            }
        });

        pond.setOptions({
            server: {
                process: {
                    url: "{{ route('images.store') }}",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }
            }
        });

    </script>
@endpush
