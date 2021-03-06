@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title py-4">Todos los posts</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Creación</th>
                                <th>Propietario</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{!!  Str::limit($post->description, 20)  !!}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td class="options">
                                        <a href="http://127.0.0.1:8000/posts/{{$post->id}}" class="btn btn-sm btn-secondary text-white" data-toggle="tooltip"
                                            title="Ver post"><i class="ti-eye font-bold"></i></a>
                                        
                                        <a href="{{ route('admin.posts.images', $post) }}"
                                            class="btn btn-sm btn-warning text-white" data-toggle="tooltip"
                                            title="Imágenes"><i class="ti-gallery font-bold"></i></a>
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="btn btn-sm btn-primary text-white" data-toggle="tooltip"
                                            title="Editar post"><i class="ti-pencil font-bold"></i></a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                            >
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="Eliminar post"><i class="ti-trash font-bold"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
@endpush
@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script>
       $("#myTable").DataTable({
            responsive:true
        });
    </script>
@endpush
