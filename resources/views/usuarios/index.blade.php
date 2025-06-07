<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Lista de Usuarios</h2>
                        @can('usuarios.create')
                        <a href="{{ route('usuarios.create') }}" class="btn btn-primary float-end">Crear Usuario</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Email Verificado</th>
                                        <th>Foto de Perfil</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->email_verified_at ? date('d/m/Y H:i', strtotime($user->email_verified_at)) : 'No verificado' }}</td>
                                        <td>
                                            <img src="{{ $user->profile_photo_url }}" alt="Foto de perfil" class="rounded-circle" width="50">
                                        </td>
                                        <td>{{ date('d/m/Y H:i', strtotime($user->created_at)) }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($user->updated_at)) }}</td>
                                        <td>
                                            @if($user->roles->count())
                                                {{ $user->roles->pluck('name')->join(', ') }}
                                            @else
                                                Sin rol
                                            @endif
                                        </td>
                                        <td>
                                            @can('usuarios.edit')
                                            <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-warning">Editar</a>
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
        </div>
    </div>
</x-guest-layout>