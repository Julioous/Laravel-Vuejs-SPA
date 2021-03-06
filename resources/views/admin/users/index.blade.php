@extends('admin.layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title py-4">{{auth()->user()->hasRole('admin')?'Usuarios':'Mi usuario'}}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Posts</th>                             
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{!! $user->email !!}</td>
                                    <td>{{ $user->posts->count() }}</td>
                                    <td class="options">
                                        @can('update',auth()->user())
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="btn btn-primary btn-sm text-white" data-toggle="tooltip"
                                            title="Editar usuario"><i class="ti-pencil font-bold"></i></a>
                                        @endcan
                                        @can('delete',auth()->user())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                title="Eliminar usuario"><i class="ti-trash font-bold"></i></button>
                                        </form>
                                        @endcan
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
